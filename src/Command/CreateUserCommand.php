<?php

namespace App\Command;

// Adapter App\Entity\User selon la classe réelle de votre utilisateur
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserCommand extends Command
{
    private UserPasswordHasherInterface $passwordEncoder;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('user:create')
            ->setDescription('Create a user.')
            ->setDefinition(array(
                new InputArgument('first-name', InputArgument::REQUIRED, 'The first name'),
                new InputArgument('last-name', InputArgument::REQUIRED, 'The last name'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputOption('admin', null, InputOption::VALUE_NONE, 'Set the user as admin (ROLE_ADMIN)'),
            ))
            ->setHelp(<<<'EOT'
The <info>user:create</info> command creates a user:

  <info>php %command.full_name% romaric@netinfluence.ch</info>

This interactive shell will ask you for a password.

You can create an admin via the admin flag:

  <info>php %command.full_name% user:create --admin</info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $firstName = $input->getArgument('first-name');
        $lastName = $input->getArgument('last-name');
        $password = $input->getArgument('password');
        $admin = $input->getOption('admin');

        $user = (new User())
            ->setEmail($email)
            ->setRoles($admin ? ['ROLE_ADMIN'] : ['ROLE_USER'])
        ;

        $password = $this->passwordEncoder->hashPassword($user, $password);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln(sprintf('Created user <comment>%s</comment>', $email));
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $questions = array();
        $questions['first-name'] = new Question('first name: ');
        $questions['last-name'] = new Question('last name: ');
        $questions['email'] = new Question('email: ');

        if (!$input->getArgument('password')) {
            $question = new Question('Please choose a password:');
            $question->setValidator(function ($password) {
                if (empty($password)) {
                    throw new Exception('Password can not be empty');
                }

                return $password;
            });
            $question->setHidden(true);
            $questions['password'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}
