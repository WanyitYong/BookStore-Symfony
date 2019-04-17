<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Book;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function load(ObjectManager $manager)
    {
        $User = $this->createUser('user', 'user');
        $User2 = $this->createUser('seller', 'seller');
        $User3 = $this->createUser('buyer', 'buyer');
        $Admin = $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
        $Admin2 = $this->createUser('Matt', 'Smith', ['ROLE_ADMIN']);

        $manager->persist($User);
        $manager->persist($User2);
        $manager->persist($User3);
        $manager->persist($Admin);
        $manager->persist($Admin2);

        $book1 = $this->createBook("A Dog's Journey", "W. Bruce Cameron", $User, 16.98, "After searching for his purpose through several eventful lives, Buddy is sure that he has found and fulfilled it. Yet as he watches curious baby Clarity get into dangerous mischief, he is certain that this little girl is very much in need of a dog of her own.
When Buddy is reborn, he realizes that he has a new destiny. He's overjoyed when he is adopted by Clarity, now a vibrant but troubled teenager. When they are suddenly separated, Buddy despairs-who will take care of his girl? 
A charming and heartwarming story of hope and unending devotion, A Dog's Journey is the moving story of unwavering loyalty and a love that crosses all barriers. ", "/images/aDogJourney.jpg");
        $book2 = $this->createBook("A Paris Year: My Day-to-day Adventures In The Most Romantic...", "Janice Macleod", $User2, 19.79, "Part memoir and part visual journey through the streets of modern-day Paris, France, A Paris Year chronicles, day by day, one woman's French sojourn in the world's most beautiful city. Beginning on her first day in Paris, Janice MacLeod, the author of the best-selling book, Paris Letters, began a journal recording in illustrations and words, nearly every sight, smell, taste, and thought she experienced in the City of Light. The end result is more than a diary: it's a detailed and colorful love letter to one of the most romantic and historically rich cities on earth. Combining personal observations and anecdotes with stories and facts about famous figures in Parisian history, this visual tale of discovery, through the eyes of an artist, is sure to delight, inspire, and charm.", "/images/aParisYear.jpg");
        $book3 = $this->createBook("Destinations Of A Lifetime: 225 Of The World's Most Amazing Places", "National Geographic", $User, 29.16, "NatGeo takes you on a photographic tour of the world’s most spectacular destinations, inspiring tangible ideas for your next trip. Travel to hundreds of the most breathtaking locales—both natural and man-made—illustrated with vivid images taken by the organization's world-class photographers. These images, coupled with evocative text, feature a plethora of visual wonders: ancient monoliths, scenic islands, stunning artwork, electric cityscapes, white-sand seashores, rain forests, ancient cobbled streets, and both classic and innovative architecture. Loaded with hard service information for each location, Destinations of a Lifetime has it all: when to go, where to eat, where to stay, and what to do to ensure the most enriching and authentic experience.", "/images/destination.jpg");
        $book4 = $this->createBook("Find Momo Across Europe", "Andrew Knapp", $User, 13.69, "Play hide-and-seek with Momo, the bandana-wearing, head-tilting border collie who loves to tuck himself away for the stunning photographs taken by his BFF Andrew. The pair’s first books—Find Momo, Find Momo Coast to Coast, and the board book Let’s Find Momo!—explored landmarks and little-known places across the US and Canada. This new addition features beautiful cities and landscapes throughout Europe. Join Andrew and Momo on their travels to Spain, Portugal, Italy, France, the UK, and more. See if you can spot Momo concealed in picturesque neighborhoods, among ancient ruins, around castles and cathedrals, at legendary attractions, and in off-the-beaten-path locations that only these seasoned travelers could find. It’s the grand tour of Europe you’ve always wanted—with Momo’s cute and happy face waiting for you at every destination.", "/images/findMomo.jpg");
        $book5 = $this->createBook("Hey Warrior", "Karen Young", $User, 14.32, "Kids can do amazing things with the right information. Understanding why anxiety feels the way it does and where the physical symptoms come from is a powerful step in turning anxiety around. Anxiety explained, kids empowered.", "/images/heyWarrior.png");
        $book6 = $this->createBook("I Want My Hat Back", "Jon Klassen", $User2, 7.25, "A bear searches for his missing hat in the bestselling, multiple award-winning picture book debut of Jon Klassen. 
In his bestselling debut picture book, the multiple award-winning Jon Klassen, illustrator of This Is Not My Hat and Sam and Dave Dig a Hole, tells the story of a bear who's hat has gone. And he wants it back. Patiently and politely, he asks the animals he comes across, one by one, whether they have seen it. Each animal says no (some more elaborately than others). But just as it he begins to lose hope, lying flat on his back in despair, a deer comes by and asks a rather obvious question that suddenly sparks the bear's memory and renews his search with a vengeance... Told completely in dialogue, this quirky, hilarious, read-aloud tale plays out in sly illustrations brimming with visual humour and winks at the reader who will be thrilled to be in on the joke. ", "/images/iWantMyHatBack.jpg");
        $book7 = $this->createBook("Pet Sematary", "Karen Young", $User, 14.32, "When Dr. Louis Creed takes a new job and moves his family to the idyllic rural town of Ludlow, Maine, this new beginning seems too good to be true. Despite Ludlow’s tranquility, an undercurrent of danger exists here. Those trucks on the road outside the Creed’s beautiful old home travel by just a little too quickly, for one thing…as is evidenced by the makeshift graveyard in the nearby woods where generations of children have buried their beloved pets. Then there are the warnings to Louis both real and from the depths of his nightmares that he should not venture beyond the borders of this little graveyard where another burial ground lures with seductive promises and ungodly temptations. A blood-chilling truth is hidden there—one more terrifying than death itself, and hideously more powerful. As Louis is about to discover for himself sometimes, dead is better…", "/images/sematary.jpg");
        $book8 = $this->createBook("The Huntress", "Kate Quinn", $User2, 12.99, "In the aftermath of war, the hunter becomes the hunted…
Bold and fearless, Nina Markova always dreamed of flying. When the Nazis attack the Soviet Union, she risks everything to join the legendary Night Witches, an all-female night bomber regiment wreaking havoc on the invading Germans. When she is stranded behind enemy lines, Nina becomes the prey of a lethal Nazi murderess known as the Huntress, and only Nina’s bravery and cunning will keep her alive.", "/images/huntress.jpg");
        $book9 = $this->createBook("The Hunger Games Series", "Suzanne Collins", $Admin, 39.15, "In the ruins of a place once known as North America lies the nation of Panem, a shining Capitol surrounded by twelve outlying districts. The Capitol is harsh and cruel and keeps the other districts in line by forcing them to participate in the annual Hunger Games, a fight-to-the-death on live TV. 
One boy and one girl between the ages of twelve and sixteen are selected by lottery to play. The winner brings riches and favor tohis or her district. But that is nothing compared to what the Capitol wins: one more year of fearful compliance with its rule. Sixteen-year-old Katniss Everdeen, who lives alone with her mother and younger sister, regards it as a death sentence when she is forced to represent her impoverished district in the Games. 
But Katniss has been close to dead before - and survival, for her, is second nature. Without really meaning to, she becomes a contender. But if she is to win, she will have to start making choices that weigh survival against humanity and life against love. ", "/images/hunger.jpg");
        $book10 = $this->createBook("Thinking, Fast And Slow", "Daniel Kahneman", $User2, 14.66, "Two systems drive the way we think and make choices, Daniel Kahneman explains: System One is fast, intuitive, and emotional; System Two is slower, more deliberative, and more logical. Examining how both systems function within the mind, Kahneman exposes the extraordinary capabilities as well as the biases of fast thinking and the pervasive influence of intuitive impressions on our thoughts and our choices. Engaging the reader in a lively conversation about how we think, he shows where we can trust our intuitions and how we can tap into the benefits of slow thinking, contrasting the two-system view of the mind with the standard model of the rational economic agent.
Kahneman's singularly influential work has transformed cognitive psychology and launched the new fields of behavioral economics and happiness studies. In this path-breaking book, Kahneman shows how the mind works, and offers practical and enlightening insights into how choices are made in both our business and personal lives--and how we can guard against the mental glitches that often get us into trouble.", "/images/thinking.jpg");

        $manager->persist($book1);
        $manager->persist($book2);
        $manager->persist($book3);
        $manager->persist($book4);
        $manager->persist($book5);
        $manager->persist($book6);
        $manager->persist($book7);
        $manager->persist($book8);
        $manager->persist($book9);
        $manager->persist($book10);

        $manager->flush();
    }

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    { $this->passwordEncoder = $passwordEncoder; }

    private function createUser($username, $plainPassword, $roles = ['ROLE_USER']):User
    {
        $user = new User();
        $user->setUsername($username);
        $user->setRoles($roles);

        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        return $user;
    }

    private function createBook($title, $author,User $seller, $price, $description, $image):Book
    {
        $book = new Book();
        $book->setTitle($title);
        $book->setAuthor($author);
        $book->setSeller($seller);
        $book->setPrice($price);
        $book->setDescription($description);
        $book->setImage($image);

        return $book;
    }
}
