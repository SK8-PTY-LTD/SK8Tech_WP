<?php
/*
Plugin Name: Quote of the Day and Random Quote
Plugin URI: http://wordpress.org/plugins/quote-of-the-day-and-random-quote/
Description: A Quote of the Day or a Random Quote on your website
Version: 1.2
Author: WeLoveQuotes.net
Author URI: http://welovequotes.net
License: GPL2

  Copyright 2013  WeLoveQuotes.net  (email : mail@dailyverses.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function welovequotes_add_my_stylesheet() {
	wp_register_style( 'welovequotes-style', plugins_url('quote-of-the-day-and-random-quote.css', __FILE__) );
	wp_enqueue_style( 'welovequotes-style' );
}

add_action( 'wp_enqueue_scripts', 'welovequotes_add_my_stylesheet' );

function get_quote($number)
{
	$listOfQuotes = array("<div class=\"weLoveQuotes quote\">Any man who can drive safely while kissing a pretty girl is simply not giving the kiss the attention it deserves.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Even the rich are hungry for love, for being cared for, for being wanted, for having someone to call their own.</div><div class=\"weLoveQuotes author\">Mother Teresa</div>", 
"<div class=\"weLoveQuotes quote\">Some cause happiness wherever they go; others whenever they go.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">He has no enemies, but is intensely disliked by his friends.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">He that is good for making excuses is seldom good for anything else.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">It is well enough that people of the nation do not understand our banking and monetary system, for if they did, I believe there would be a revolution before tomorrow morning.</div><div class=\"weLoveQuotes author\">Henry Ford</div>", 
"<div class=\"weLoveQuotes quote\">There are three classes of people: those who see, those who see when they are shown, those who do not see.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">The only person you are destined to become is the person you decide to be.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">Wisdom begins in wonder.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">Be kind and compassionate to one another, forgiving each other, just as in Christ God forgave you.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">An honest man is always a child.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">The hardest thing to understand in the world is the income tax.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Don't cry because it's over. Smile because it happened.</div><div class=\"weLoveQuotes author\">Dr. Seuss</div>", 
"<div class=\"weLoveQuotes quote\">Worthless people live only to eat and drink; people of worth eat and drink only to live.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">I remember my mother's prayers and they have always followed me. They have clung to me all my life.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">Our society is run by insane people for insane objectives. I think we're being run by maniacs for maniacal ends and I think I'm liable to be put away as insane for expressing that. That's what's insane about it.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Love the Lord your God with all your heart and with all your soul and with all your mind and with all your strength.’ The second is this: ‘Love your neighbor as yourself.’ There is no commandment greater than these.</div><div class=\"weLoveQuotes author\">Jesus Christ</div>", 
"<div class=\"weLoveQuotes quote\">A hero is no braver than an ordinary man, but he is brave five minutes longer.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">Life is pretty simple: You do some stuff. Most fails. Some works. You do more of what works. If it works big, others quickly copy it. Then you do something else. The trick is the doing something else.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">Who has not served cannot command.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">We look at science as something very elite, which only a few people can learn. That's just not true. You just have to start early and give kids a foundation. Kids live up, or down, to expectations.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">Dogs never bite me - just humans.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">You don't need anybody to tell you who you are or what you are. You are what you are!</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Think three times before you move.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Fishes live in the sea, as men do a-land; the great ones eat up the little ones.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">God has given you one face, and you make yourself another.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">When it is obvious that the goals cannot be reached, don't adjust the goals, adjust the action steps.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">You miss 100% of the shots you don’t take.</div><div class=\"weLoveQuotes author\">Wayne Gretzky</div>", 
"<div class=\"weLoveQuotes quote\">You can fool all the people some of the time, and some of the people all the time, but you cannot fool all the people all the time.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">Life is a series of natural and spontaneous changes. Don't resist them - that only creates sorrow. Let reality be reality. Let things flow naturally forward in whatever way they like.</div><div class=\"weLoveQuotes author\">Lao Tzu</div>", 
"<div class=\"weLoveQuotes quote\">What you don't know can't hurt you.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">A good hockey player plays where the puck is. A great hockey player plays where the puck is going to be.</div><div class=\"weLoveQuotes author\">Wayne Gretzky</div>", 
"<div class=\"weLoveQuotes quote\">Love all, trust a few, do wrong to none.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">Character develops itself in the stream of life.</div><div class=\"weLoveQuotes author\">Johann Wolfgang von Goethe</div>", 
"<div class=\"weLoveQuotes quote\">God is a concept by which we measure our pain.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Sex without love is a meaningless experience, but as far as meaningless experiences go its pretty damn good.</div><div class=\"weLoveQuotes author\">Woody Allen</div>", 
"<div class=\"weLoveQuotes quote\">To forget one's purpose is the commonest form of stupidity.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">The function of education is to teach one to think intensively and to think critically. Intelligence plus character - that is the goal of true education.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">I have no special talent. I am only passionately curious.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">You can design and create, and build the most wonderful place in the world. But it takes people to make the dream a reality.</div><div class=\"weLoveQuotes author\">Walt Disney</div>", 
"<div class=\"weLoveQuotes quote\">Healthy citizens are the greatest asset any country can have.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">All you need is love.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Imperfection is beauty, madness is genius and it's better to be absolutely ridiculous than absolutely boring.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">Science without religion is lame, religion without science is blind.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Women are made to be loved, not understood.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Even monkeys fall from trees</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">It takes as much energy to wish as it does to plan.</div><div class=\"weLoveQuotes author\">Eleanor Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">Three things cannot be long hidden: the sun, the moon, and the truth.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">Weakness of attitude becomes weakness of character.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Be sure you put your feet in the right place, then stand firm.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">When there is an income tax, the just man will pay more and the unjust less on the same amount of income.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">The only way to have a friend is to be one.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">Giving birth to a baby is easier than worrying about it.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The greatest gift that you can give to others is the gift of unconditional love and acceptance.</div><div class=\"weLoveQuotes author\">Brian Tracy</div>", 
"<div class=\"weLoveQuotes quote\">I always like to look on the optimistic side of life, but I am realistic enough to know that life is a complex matter.</div><div class=\"weLoveQuotes author\">Walt Disney</div>", 
"<div class=\"weLoveQuotes quote\">Distrust is the mother of safety.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">At any rate, am convinced that He (God) does not play dice with the universe.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">A man can be happy with any woman, as long as he does not love her.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Today you are you! That is truer than true! There is no one alive who is you-er than you!</div><div class=\"weLoveQuotes author\">Dr. Seuss</div>", 
"<div class=\"weLoveQuotes quote\">Is the reality of your situation the problem, or do you just have a problem with reality?</div><div class=\"weLoveQuotes author\">Alan Robert Neal</div>", 
"<div class=\"weLoveQuotes quote\">A man's face is his autobiography. A woman's face is her work of fiction.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Everything you’ve ever wanted is on the other side of fear.</div><div class=\"weLoveQuotes author\">George Addair</div>", 
"<div class=\"weLoveQuotes quote\">Intense love does not measure, it just gives.</div><div class=\"weLoveQuotes author\">Mother Teresa</div>", 
"<div class=\"weLoveQuotes quote\">Talent without discipline is like an octopus on roller skates. There's plenty of movement, but you never know if it's going to be forward, backwards, or sideways.</div><div class=\"weLoveQuotes author\">H. Jackson Brown, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">A primitive artist is an amateur whose work sells.</div><div class=\"weLoveQuotes author\">Grandma Moses</div>", 
"<div class=\"weLoveQuotes quote\">Mistakes are always forgivable, if one has the courage to admit them.</div><div class=\"weLoveQuotes author\">Bruce Lee</div>", 
"<div class=\"weLoveQuotes quote\">Never put off till tomorrow what you can do the day after tomorrow.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">The coward only threatens when he is safe.</div><div class=\"weLoveQuotes author\">Johann Wolfgang von Goethe</div>", 
"<div class=\"weLoveQuotes quote\">Teach a man to take a fish is not equal to teach a man how to fish.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Life would be infinitely happier if we could only be born at the age of eighty and gradually approach eighteen.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">My attitude is that if you push me towards something that you think is a weakness, then I will turn that perceived weakness into a strength.</div><div class=\"weLoveQuotes author\">Michael Jordan</div>", 
"<div class=\"weLoveQuotes quote\">Do nothing out of selfish ambition or vain conceit. Rather, in humility value others above yourselves.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">The mind governed by the flesh is death, but the mind governed by the Spirit is life and peace.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">Adults are obsolete children.</div><div class=\"weLoveQuotes author\">Dr. Seuss</div>", 
"<div class=\"weLoveQuotes quote\">By all means, marry. If you get a good wife, you'll become happy. If you get a bad one, you'll become a philosopher.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">First they ignore you, then they laugh at you, then they fight you, then you win.</div><div class=\"weLoveQuotes author\">Mahatma Gandhi</div>", 
"<div class=\"weLoveQuotes quote\">Do the right thing. It will gratify some people and astonish the rest.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Friends can help each other. A true friend is someone who lets you have total freedom to be yourself - and especially to feel. Or, not feel. Whatever you happen to be feeling at the moment is fine with them. That's what real love amounts to - letting a person be what he really is.</div><div class=\"weLoveQuotes author\">Jim Morrison</div>", 
"<div class=\"weLoveQuotes quote\">As you simplify your life, the laws of the universe will be simpler; solitude will not be solitude, poverty will not be poverty, nor weakness weakness.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">Never, never, never give up.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">Find out how much God has given you and from it take what you need; the remainder is needed by others.</div><div class=\"weLoveQuotes author\">Saint Augustine</div>", 
"<div class=\"weLoveQuotes quote\">Sometimes when you innovate, you make mistakes. It is best to admit them quickly, and get on with improving your other innovations.</div><div class=\"weLoveQuotes author\">Steve Jobs</div>", 
"<div class=\"weLoveQuotes quote\">You will never do anything in this world without courage. It is the greatest quality of the mind next to honor.</div><div class=\"weLoveQuotes author\">Aristotle</div>", 
"<div class=\"weLoveQuotes quote\">The only difference between the saint and the sinner is that every saint has a past, and every sinner has a future.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Such mother, such daughter.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Earth laughs in flowers.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">Honesty is the first chapter in the book of wisdom.</div><div class=\"weLoveQuotes author\">Thomas Jefferson</div>", 
"<div class=\"weLoveQuotes quote\">Start where you are. Use what you have. Do what you can.</div><div class=\"weLoveQuotes author\">Arthur Ashe</div>", 
"<div class=\"weLoveQuotes quote\">The farther backward you can look, the farther forward you can see.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">A table, a chair, a bowl of fruit and a violin; what else does a man need to be happy?</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">When we are born we cry that we are come to this great stage of fools.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">When you are courting a nice girl an hour seems like a second. When you sit on a red-hot cinder a second seems like an hour. That's relativity.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Comfort is the enemy of achievement.</div><div class=\"weLoveQuotes author\">Farrah Gray</div>", 
"<div class=\"weLoveQuotes quote\">Anger is an acid that can do more harm to the vessel in which it is stored than to anything on which it is poured.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Do not be deceived: God cannot be mocked. A man reaps what he sows.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">When I was 5 years old, my mother always told me that happiness was the key to life. When I went to school, they asked me what I wanted to be when I grew up.  I wrote down ‘happy’. They told me I didn’t understand the assignment, and I told them they didn’t understand life.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">It is better to travel well than to arrive.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">What you reap is what you sow.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">He who cannot give anything away cannot feel anything either.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Treat those who are good with goodness, and also treat those who are not good with goodness. Thus goodness is attained. Be honest to those who are honest, and be also honest to those who are not honest. Thus honesty is attained.</div><div class=\"weLoveQuotes author\">Lao Tzu</div>", 
"<div class=\"weLoveQuotes quote\">If you do not enter the tiger's cave, you will not catch its cub.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Don't do the same thing again and expect different results.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">One should always be in love. That is the reason one should never marry.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Child of a frog is a frog.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The way to get started is to quit talking and begin doing.</div><div class=\"weLoveQuotes author\">Walt Disney</div>", 
"<div class=\"weLoveQuotes quote\">No one can be the judge in his own case.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">My favorite things in life don't cost any money. It's really clear that the most precious resource we all have is time.</div><div class=\"weLoveQuotes author\">Steve Jobs</div>", 
"<div class=\"weLoveQuotes quote\">Never bend your head. Always hold it high. Look the world straight in the eye.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">Almost always, the creative dedicated minority has made the world better.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Money is only a tool. It will take you wherever you wish, but it will not replace you as the driver.</div><div class=\"weLoveQuotes author\">Ayn Rand</div>", 
"<div class=\"weLoveQuotes quote\">There are two ways to live: you can live as if nothing is a miracle; you can live as if everything is a miracle.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">True friendship can afford true knowledge. It does not depend on darkness and ignorance.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">Before the throne of the Almighty, man will be judged not by his acts but by his intentions. For God alone reads our hearts.</div><div class=\"weLoveQuotes author\">Mahatma Gandhi</div>", 
"<div class=\"weLoveQuotes quote\">The difference between stupidity and genius is that genius has its limits.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">However many holy words you read, however many you speak, what good will they do you if you do not act on upon them?</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">If it's not an emergency, act with priority instead of urgency.</div><div class=\"weLoveQuotes author\">Alan Robert Neal</div>", 
"<div class=\"weLoveQuotes quote\">Dreams have only one owner at a time. That's why dreamers are lonely.</div><div class=\"weLoveQuotes author\">Erma Bombeck</div>", 
"<div class=\"weLoveQuotes quote\">The time is always right to do what is right.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">All the things that are white are not milk.</div><div class=\"weLoveQuotes author\">Ancient Indian Proverb</div>", 
"<div class=\"weLoveQuotes quote\">A thorough knowledge of the Bible is worth more than a college education.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">You have your way. I have my way. As for the right way, the correct way, and the only way, it does not exist.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Hell is empty and all the devils are here.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">Let no debt remain outstanding, except the continuing debt to love one another, for whoever loves others has fulfilled the law.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">If we will be quiet and ready enough, we shall find compensation in every disappointment.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">If you always need to tell me what you think, I'll need to tell you that you don't.</div><div class=\"weLoveQuotes author\">Alan Robert Neal</div>", 
"<div class=\"weLoveQuotes quote\">All successful people men and women are big dreamers. They imagine what their future could be, ideal in every respect, and then they work every day toward their distant vision, that goal or purpose.</div><div class=\"weLoveQuotes author\">Brian Tracy</div>", 
"<div class=\"weLoveQuotes quote\">If you can't explain it simply, you don't understand it well enough.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">I can accept failure, everyone fails at something. But I can't accept not trying.</div><div class=\"weLoveQuotes author\">Michael Jordan</div>", 
"<div class=\"weLoveQuotes quote\">Strive not to be a success, but rather to be of value.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Don't be threatened by that which you have already survived.</div><div class=\"weLoveQuotes author\">Alan Robert Neal</div>", 
"<div class=\"weLoveQuotes quote\">All religions, arts and sciences are branches of the same tree.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">When the solution is simple, God is answering.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Riches don't make a man rich, they only make him busier.</div><div class=\"weLoveQuotes author\">Christopher Columbus</div>", 
"<div class=\"weLoveQuotes quote\">A dreamer is one who can only find his way by moonlight, and his punishment is that he sees the dawn before the rest of the world.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">No person is your friend who demands your silence, or denies your right to grow.</div><div class=\"weLoveQuotes author\">Alice Walker</div>", 
"<div class=\"weLoveQuotes quote\">Picture yourself in your minds eye as having already achieved this goal. See yourself doing the things you'll be doing when you've reached your goal.</div><div class=\"weLoveQuotes author\">Earl Nightingale</div>", 
"<div class=\"weLoveQuotes quote\">In any moment of decision, the best thing you can do is the right thing, the next best thing is the wrong thing, and the worst thing you can do is nothing.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">Health is the greatest gift, contentment the greatest wealth, faithfulness the best relationship.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">The best thing about the future is that it comes one day at a time.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">He is richest who is content with the least, for content is the wealth of nature.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">The key to success is to focus our conscious mind on things we desire not things we fear.</div><div class=\"weLoveQuotes author\">Brian Tracy</div>", 
"<div class=\"weLoveQuotes quote\">Ten persons, ten colors</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Some of the most fun people I know are scientists.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">If something is worth doing, it is worth doing thoroughly.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Do not dwell in the past, do not dream of the future, concentrate the mind on the present moment.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">I'm not in this world to live up to your expectations and you're not in this world to live up to mine.</div><div class=\"weLoveQuotes author\">Bruce Lee</div>", 
"<div class=\"weLoveQuotes quote\">We cannot solve our problems with the same thinking we used when we created them.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Faith is the strength by which a shattered world shall emerge into the light.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">The lack of money is the root of all evil.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Be careful about reading health books. You may die of a misprint.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Intellectuals solve problems, geniuses prevent them.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Humility is not thinking less of yourself, it's thinking of yourself less.</div><div class=\"weLoveQuotes author\">C.S. Lewis</div>", 
"<div class=\"weLoveQuotes quote\">The most important part of education is proper training in the nursery.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">Life is what happens to you while you’re busy making other plans.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">No man should marry until he has studied anatomy and dissected at least one woman.</div><div class=\"weLoveQuotes author\">Honore de Balzac</div>", 
"<div class=\"weLoveQuotes quote\">Every immigrant who comes here should be required within five years to learn English or leave the country.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">There are no shortcuts to any place worth going.</div><div class=\"weLoveQuotes author\">Beverly Sills</div>", 
"<div class=\"weLoveQuotes quote\">No one has ever become poor by giving.</div><div class=\"weLoveQuotes author\">Anne Frank</div>", 
"<div class=\"weLoveQuotes quote\">If a man does not keep pace with his companions, perhaps it is because he hears a different drummer. Let him step to the music which he hears, however measured or far away.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">The hottest place in Hell is reserved for those who remain neutral in times of great moral conflict.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">No one should seek their own good, but the good of others.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">Age is an issue of mind over matter. If you don't mind, it doesn't matter.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">What lies behind us and what lies ahead of us are tiny matters compared to what lives within us.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">In every real man a child is hidden that wants to play.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Where God has a church the devil will have his chapel.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Logic will get you from A to B. Imagination will take you everywhere.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">There is no instinct like that of the heart.</div><div class=\"weLoveQuotes author\">Lord Byron</div>", 
"<div class=\"weLoveQuotes quote\">The ultimate measure of a man is not where he stands in moments of comfort and convenience, but where he stands at times of challenge and controversy.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Having nothing, nothing can he lose.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">Do not hire a man who does your work for money, but him who does it for love of it.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">It is better to be beautiful than to be good. But it is better to be good than to be ugly.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Design is not just what it looks like and feels like. Design is how it works.</div><div class=\"weLoveQuotes author\">Steve Jobs</div>", 
"<div class=\"weLoveQuotes quote\">The devil is a better theologian than any of us and is a devil still.</div><div class=\"weLoveQuotes author\">A.W. Tozer</div>", 
"<div class=\"weLoveQuotes quote\">I believe in God, but not as one thing, not as an old man in the sky. I believe that what people call God is something in all of us. I believe that what Jesus and Mohammed and Buddha and all the rest said was right. It's just that the translations have gone wrong.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Many men go fishing all of their lives without knowing that it is not fish they are after.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">Patriotism is supporting your country all the time, and your government when it deserves it.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">When the people fear the government, there is tyranny. When the government fears the people, there is liberty.</div><div class=\"weLoveQuotes author\">Thomas Jefferson</div>", 
"<div class=\"weLoveQuotes quote\">The church is a hospital for sinners, not a museum for saints.</div><div class=\"weLoveQuotes author\">Abigail Van Buren</div>", 
"<div class=\"weLoveQuotes quote\">Our greatest glory is not in never falling, but in rising every time we fall.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">Only a life lived for others is a life worthwhile.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Nobody gets justice. People only get good luck or bad luck.</div><div class=\"weLoveQuotes author\">Orson Welles</div>", 
"<div class=\"weLoveQuotes quote\">The only thing that interferes with my learning is my education.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">We could never learn to be brave and patient, if there were only joy in the world.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">I believe that banking institutions are more dangerous to our liberties than standing armies.</div><div class=\"weLoveQuotes author\">Thomas Jefferson</div>", 
"<div class=\"weLoveQuotes quote\">A pessimist sees the difficulty in every opportunity; an optimist sees the opportunity in every difficulty.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">The things that will destroy America are prosperity-at-any-price, peace-at-any-price, safety-first instead of duty-first, the love of soft living, and the get-rich-quick theory of life.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">True wisdom comes to each of us when we realize how little we understand about life, ourselves, and the world around us.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">I think science fiction helps us think about possibilities, to speculate - it helps us look at our society from a different perspective. It lets us look at our mores, using science as the backdrop, as the game changer.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">He that can have patience can have what he will.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">Life doesn't imitate art, it imitates bad television.</div><div class=\"weLoveQuotes author\">Woody Allen</div>", 
"<div class=\"weLoveQuotes quote\">Experience is one thing you can't get for nothing.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">I am absolutely convinced that no wealth in the world can help humanity forward, even in the hands of the most devoted worker in this cause. The example of great and pure personages is the only thing that can lead us to find ideas and noble deeds. Money only appeals to selfishness and always irresistibly tempts its owner to abuse it.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">The human race has one really effective weapon, and that is laughter.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Give neither salt nor counsel till you are asked for it.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">A person who never made a mistake never tried anything new.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">All generalizations are false, including this one.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">We work to become, not to acquire.</div><div class=\"weLoveQuotes author\">Elbert Hubbard</div>", 
"<div class=\"weLoveQuotes quote\">Lost time is never found again.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">Disneyland is a work of love. We didn't go into Disneyland just with the idea of making money.</div><div class=\"weLoveQuotes author\">Walt Disney</div>", 
"<div class=\"weLoveQuotes quote\">It's not what you look at that matters, it's what you see.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">In dwelling, live close to the ground. In thinking, keep to the simple. In conflict, be fair and generous. In governing, don't try to control. In work, do what you enjoy. In family life, be completely present.</div><div class=\"weLoveQuotes author\">Lao Tzu</div>", 
"<div class=\"weLoveQuotes quote\">The best way to cheer yourself up is to try to cheer somebody else up.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Fashion is a form of ugliness so intolerable that we have to alter it every six months.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">The government is us; we are the government, you and I.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">A well-spent day brings happy sleep.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">Men always want to be a woman's first love - women like to be a man's last romance.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">The nicest thing for me is sleep, then at least I can dream.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">A man is never more truthful than when he acknowledges himself a liar.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">If someone offers you a breath mint, accept it.</div><div class=\"weLoveQuotes author\">H. Jackson Brown, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Get your facts first, then you can distort them as you please.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Wisdom is found only in truth.</div><div class=\"weLoveQuotes author\">Johann Wolfgang von Goethe</div>", 
"<div class=\"weLoveQuotes quote\">I love those who can smile in trouble, who can gather strength from distress, and grow brave by reflection. It is the business of little minds to shrink, but they whose heart is firm, and whose conscience approves their conduct, will pursue their principles unto death.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">Animals are such agreeable friends - they ask no questions; they pass no criticisms.</div><div class=\"weLoveQuotes author\">George Eliot</div>", 
"<div class=\"weLoveQuotes quote\">Continuous effort - not strength or intelligence - is the key to unlocking our potential.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">Well begun is half done.</div><div class=\"weLoveQuotes author\">Aristotle</div>", 
"<div class=\"weLoveQuotes quote\">When you look into an abyss, the abyss also looks into you.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">The future belongs to those who believe in the beauty of their dreams.</div><div class=\"weLoveQuotes author\">Eleanor Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">Behavior is the mirror in which everyone shows their image.</div><div class=\"weLoveQuotes author\">Johann Wolfgang von Goethe</div>", 
"<div class=\"weLoveQuotes quote\">For a man to conquer himself is the first and noblest of all victories.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">Love is patient, love is kind. It does not envy, it does not boast, it is not proud.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">The horizon of many people is a circle with zero radius which they call their point of view.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">The greatest deception men suffer is from their own opinions.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">Teachers open the door. You enter by yourself.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Give a girl the right shoes, and she can conquer the world.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">When people laugh at Mickey Mouse, it's because he's so human; and that is the secret of his popularity.</div><div class=\"weLoveQuotes author\">Walt Disney</div>", 
"<div class=\"weLoveQuotes quote\">A truly rich man is one whose children run into his arms when his hands are empty.</div><div class=\"weLoveQuotes author\">Unknown</div>", 
"<div class=\"weLoveQuotes quote\">The most beautiful thing we can experience is the mysterious. It is the source of all true art and science.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Anyone who doesn't take truth seriously in small matters cannot be trusted in large ones either.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">The essence of all beautiful art, all great art, is gratitude.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Do your work with your whole heart, and you will succeed - there's so little competition.</div><div class=\"weLoveQuotes author\">Elbert Hubbard</div>", 
"<div class=\"weLoveQuotes quote\">Time you enjoy wasting, was not wasted.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Not knowing is Buddha.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Where there is love, there is grief.</div><div class=\"weLoveQuotes author\">Ancient Indian Proverb</div>", 
"<div class=\"weLoveQuotes quote\">I don't mind making jokes, but I don't want to look like one.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">The only stupid question is the one not asked.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">When I was young I thought that money was the most important thing in life; now that I am old I know that it is.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Every artist was first an amateur.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">If I give all I possess to the poor and give over my body to hardship that I may boast, but do not have love, I gain nothing.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">The only way a kid is going to practice is if it's total fun for him... and it was for me.</div><div class=\"weLoveQuotes author\">Wayne Gretzky</div>", 
"<div class=\"weLoveQuotes quote\">All truly great thoughts are conceived by walking.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">You know, you don't have to have money to be a successful businessperson. You don't need a college degree. You just need a lot of common sense backed up by a willingness to work hard.</div><div class=\"weLoveQuotes author\">Farrah Gray</div>", 
"<div class=\"weLoveQuotes quote\">True friends stab you in the front.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">For the theatre one needs long arms... an artist with short arms can never make a fine gesture.</div><div class=\"weLoveQuotes author\">Sarah Bernhardt</div>", 
"<div class=\"weLoveQuotes quote\">Man's schemes are inferior to those made by heaven.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Luck exists in the leftovers.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">What consumerism really is, at its worst is getting people to buy things that don't actually improve their lives.</div><div class=\"weLoveQuotes author\">Jeffrey Bezos</div>", 
"<div class=\"weLoveQuotes quote\">Attitude is a little thing that makes a big difference.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">People seldom do what they believe in. They do what is convenient, then repent.</div><div class=\"weLoveQuotes author\">Bob Dylan</div>", 
"<div class=\"weLoveQuotes quote\">Without music, life would be a mistake.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">If art is to nourish the roots of our culture, society must set the artist free to follow his vision wherever it takes him.</div><div class=\"weLoveQuotes author\">John F. Kennedy</div>", 
"<div class=\"weLoveQuotes quote\">The evil that men do lives after them; the good is oft interred with their bones.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">The two most important days in your life are the day you are born and the day you find out why.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Darkness cannot drive out darkness; only light can do that. Hate cannot drive out hate; only love can do that.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Early bird gets the worm.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">At the touch of love everyone becomes a poet.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">If you do not change direction, you may end up where you are heading.</div><div class=\"weLoveQuotes author\">Lao Tzu</div>", 
"<div class=\"weLoveQuotes quote\">What is the use of crying when the birds ate the whole farm?</div><div class=\"weLoveQuotes author\">Ancient Indian Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Half a truth is often a great lie.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">The greatest wealth is to live content with little.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">People ask the difference between a leader and a boss. The leader leads, and the boss drives.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">America will never be destroyed from the outside. If we falter and lose our freedoms, it will be because we destroyed ourselves.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">We must learn to live together as brothers or perish together as fools.</div><div class=\"weLoveQuotes author\">Martin Luther King, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Better to remain silent and be thought a fool than to speak out and remove all doubt.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">Evil cause, evil effect</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">It takes 20 years to build a reputation and five minutes to ruin it. If you think about that, you'll do things differently.</div><div class=\"weLoveQuotes author\">Warren Buffett</div>", 
"<div class=\"weLoveQuotes quote\">Make everything as simple as possible, but not simpler.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">It's not that I'm so smart, it's just that I stay with problems longer.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">The only way to keep your health is to eat what you don't want, drink what you don't like, and do what you'd rather not.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Give me six hours to chop down a tree and I will spend the first four sharpening the axe.</div><div class=\"weLoveQuotes author\">Abraham Lincoln</div>", 
"<div class=\"weLoveQuotes quote\">I have the simplest tastes. I am always satisfied with the best.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Don't put all your eggs in the same basket.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">It is absurd to divide people into good and bad. People are either charming or tedious.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">He who is not a good servant will not be a good master.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">Your success and happiness lies in you. Resolve to keep happy, and your joy and you shall form an invincible host against difficulties.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">If others are allowed to, that does not mean you are.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Peace begins with a smile.</div><div class=\"weLoveQuotes author\">Mother Teresa</div>", 
"<div class=\"weLoveQuotes quote\">Wisdom is power.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">In a country well governed, poverty is something to be ashamed of. In a country badly governed, wealth is something to be ashamed of.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">Hope in reality is the worst of all evils because it prolongs the torments of man.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Well done is better than well said.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">Music is everybody's possession. It's only publishers who think that people own it.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">Let us purify ourselves from everything that contaminates body and spirit, perfecting holiness out of reverence for God.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">Spread love everywhere you go. Let no one ever come to you without leaving happier.</div><div class=\"weLoveQuotes author\">Mother Teresa</div>", 
"<div class=\"weLoveQuotes quote\">You can’t fall if you don’t climb.  But there’s no joy in living your whole life on the ground.</div><div class=\"weLoveQuotes author\">Unknown</div>", 
"<div class=\"weLoveQuotes quote\">Painting's not important. The important thing is keeping busy.</div><div class=\"weLoveQuotes author\">Grandma Moses</div>", 
"<div class=\"weLoveQuotes quote\">We are what we believe we are.</div><div class=\"weLoveQuotes author\">C.S. Lewis</div>", 
"<div class=\"weLoveQuotes quote\">When the wind of change blows, some build walls, while others build windmills.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Keep your face to the sunshine and you cannot see a shadow.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">The most important single ingredient in the formula of success is knowing how to get along with people.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">The only true wisdom is in knowing you know nothing.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">A small hole not mended in time, will become a big hole much more difficult to mend.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Insanity: doing the same thing over and over again and expecting different results.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">People with clear, written goals, accomplish far more in a shorter period of time than people without them could ever imagine.</div><div class=\"weLoveQuotes author\">Brian Tracy</div>", 
"<div class=\"weLoveQuotes quote\">He who has much, desires more.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Madness is rare in individuals - but in groups, parties, nations, and ages it is the rule.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">How well you live makes a difference, not how long.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Selfishness is not living as one wishes to live, it is asking others to live as one wishes to live.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Listen to many, speak to a few.</div><div class=\"weLoveQuotes author\">William Shakespeare</div>", 
"<div class=\"weLoveQuotes quote\">Fear is the mother of morality.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Learn from yesterday, live for today, hope for tomorrow. The important thing is not to stop questioning.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Don't have too many irons in the fire.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">False words are not only evil in themselves, but they infect the soul with evil.</div><div class=\"weLoveQuotes author\">Socrates</div>", 
"<div class=\"weLoveQuotes quote\">Better a diamond with a flaw than a pebble without.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">The roots of education are bitter, but the fruit is sweet.</div><div class=\"weLoveQuotes author\">Aristotle</div>", 
"<div class=\"weLoveQuotes quote\">If one does not plow, there will be no harvest.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">A business that makes nothing but money is a poor business.</div><div class=\"weLoveQuotes author\">Henry Ford</div>", 
"<div class=\"weLoveQuotes quote\">The mind is everything. What you think you become.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">I just like to keep my money in the bank; I'm not a big risk-taker. I don't know anything about the stock market... I stay away from things I don't know anything about.</div><div class=\"weLoveQuotes author\">Wayne Gretzky</div>", 
"<div class=\"weLoveQuotes quote\">Whenever I climb I am followed by a dog called 'Ego'.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">We can do anything we want to if we stick to it long enough.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">Education is what remains after one has forgotten what one has learned in school.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">This world is but a canvas to our imagination.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">A superior man is modest in his speech, but exceeds in his actions.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">It takes many good deeds to build a good reputation, and only one bad one to lose it.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">The superior man understands what is right; the inferior man understands what will sell.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">Some people say they feel very small when they think about space. I felt more expansive, very connected to the universe.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">You must have chaos within you to give birth to a dancing star.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Being deeply loved by someone gives you strength, while loving someone deeply gives you courage.</div><div class=\"weLoveQuotes author\">Lao Tzu</div>", 
"<div class=\"weLoveQuotes quote\">Be joyful in hope, patient in affliction, faithful in prayer.</div><div class=\"weLoveQuotes author\">Apostle Paul</div>", 
"<div class=\"weLoveQuotes quote\">If the wind comes from an empty cave, it's not without a reason.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Better a little which is well done, than a great deal imperfectly.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">Price is what you pay. Value is what you get.</div><div class=\"weLoveQuotes author\">Warren Buffett</div>", 
"<div class=\"weLoveQuotes quote\">Peace comes from within. Do not seek it without.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">It is easy to hate and it is difficult to love. This is how the whole scheme of things works. All good things are difficult to achieve; and bad things are very easy to get.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">The weak are meat; the strong eat.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">There are even bugs that eat knotweed.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The price of anything is the amount of life you exchange for it.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">Think big thoughts but relish small pleasures.</div><div class=\"weLoveQuotes author\">H. Jackson Brown, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">A man may die, nations may rise and fall, but an idea lives on.</div><div class=\"weLoveQuotes author\">John F. Kennedy</div>", 
"<div class=\"weLoveQuotes quote\">By three methods we may learn wisdom: First, by reflection, which is noblest; Second, by imitation, which is easiest; and third by experience, which is the bitterest.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">Science provides an understanding of a universal experience. Arts provide a universal understanding of a personal experience.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">Jesus was all right, but his disciples were thick and ordinary. It's them twisting it that ruins it for me.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">The rich man is the one who thinks to himself that nothing was lacking.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Success consists of going from failure to failure without loss of enthusiasm.</div><div class=\"weLoveQuotes author\">Winston Churchill</div>", 
"<div class=\"weLoveQuotes quote\">It is my ambition to say in ten sentences what others say in a whole book.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Authority, not truth, makes law.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">It is the working man who is the happy man. It is the idle man who is the miserable man.</div><div class=\"weLoveQuotes author\">Benjamin Franklin</div>", 
"<div class=\"weLoveQuotes quote\">A woman knows by intuition, or instinct, what is best for herself.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">Great spirits have always encountered violent opposition from mediocre minds.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Once you make a decision, the universe conspires to make it happen.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">The most I can do for my friend is simply be his friend.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">Whoever controls the media, controls the mind.</div><div class=\"weLoveQuotes author\">Jim Morrison</div>", 
"<div class=\"weLoveQuotes quote\">The more I see the less I know for sure.</div><div class=\"weLoveQuotes author\">John Lennon</div>", 
"<div class=\"weLoveQuotes quote\">It's not the size of the dog in the fight, it's the size of the fight in the dog.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Try not to become a man of success, but rather try to become a man of value.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">What we find is that if you have a goal that is very, very far out, and you approach it in little steps, you start to get there faster. Your mind opens up to the possibilities.</div><div class=\"weLoveQuotes author\">Mae Jemison</div>", 
"<div class=\"weLoveQuotes quote\">Self-pity is our worst enemy and if we yield to it, we can never do anything wise in this world.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">Do not go where the path may lead, go instead where there is no path and leave a trail.</div><div class=\"weLoveQuotes author\">Ralph Waldo Emerson</div>", 
"<div class=\"weLoveQuotes quote\">Great minds discuss ideas; average minds discuss events; small minds discuss people.</div><div class=\"weLoveQuotes author\">Eleanor Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">The highest result of education is tolerance.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">It is not a lack of love, but a lack of friendship that makes unhappy marriages.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">If I hadn't started painting, I would have raised chickens.</div><div class=\"weLoveQuotes author\">Grandma Moses</div>", 
"<div class=\"weLoveQuotes quote\">Truth is hidden, but nothing is more beautiful than the truth.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Reality can't compete with imagination.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">When marrying, ask yourself this question: Do you believe that you will be able to converse well with this person into your old age? Everything else in marriage is transitory.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Look deep into nature, and then you will understand everything better.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Our goal is to make the best devices in the world, not to be the biggest.</div><div class=\"weLoveQuotes author\">Steve Jobs</div>", 
"<div class=\"weLoveQuotes quote\">Man is least himself when he talks in his own person. Give him a mask, and he will tell you the truth.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">The remedy is often worse than the disease; Burn not your house to rid it of the mouse.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">We are not born for ourselves alone.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Dreaming about being an actress, is more exciting then being one.</div><div class=\"weLoveQuotes author\">Marilyn Monroe</div>", 
"<div class=\"weLoveQuotes quote\">Go confidently in the direction of your dreams. Live the life you have imagined.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">As much as needed, enough.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Rest is the best medicine.</div><div class=\"weLoveQuotes author\">Latin Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The stake that sticks up gets hammered down.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The best time to plant a tree was 20 years ago. The second best time is now.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The true sign of intelligence is not knowledge but imagination.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">There is always some madness in love. But there is also always some reason in madness.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">Where the spirit does not work with the hand, there is no art.</div><div class=\"weLoveQuotes author\">Leonardo da Vinci</div>", 
"<div class=\"weLoveQuotes quote\">Selfish persons are incapable of loving others, but they are not capable of loving themselves either.</div><div class=\"weLoveQuotes author\">Erich Fromm</div>", 
"<div class=\"weLoveQuotes quote\">We love life, not because we are used to living but because we are used to loving.</div><div class=\"weLoveQuotes author\">Friedrich Nietzsche</div>", 
"<div class=\"weLoveQuotes quote\">The language of friendship is not words but meanings.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">The only thing worse than being blind is having sight but no vision.</div><div class=\"weLoveQuotes author\">Helen Keller</div>", 
"<div class=\"weLoveQuotes quote\">The only source of knowledge is experience.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Only two things are infinite, the universe and human stupidity, and I'm not sure about the former.</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">The way is not in the sky. The way is in the heart.</div><div class=\"weLoveQuotes author\">Buddha</div>", 
"<div class=\"weLoveQuotes quote\">I love those who yearn for the impossible.</div><div class=\"weLoveQuotes author\">Johann Wolfgang von Goethe</div>", 
"<div class=\"weLoveQuotes quote\">You can discover more about a person in an hour of play than in a year of conversation.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">The person who says it cannot be done should not interrupt the person who is doing it.</div><div class=\"weLoveQuotes author\">Chinese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">The world is a dangerous place to live; not because of the people who are evil, but because of the people who don't do anything about it...</div><div class=\"weLoveQuotes author\">Albert Einstein</div>", 
"<div class=\"weLoveQuotes quote\">Disobedience is the true foundation of liberty. The obedient must be slaves.</div><div class=\"weLoveQuotes author\">Henry David Thoreau</div>", 
"<div class=\"weLoveQuotes quote\">I meant what I said and I said what I meant.</div><div class=\"weLoveQuotes author\">Dr. Seuss</div>", 
"<div class=\"weLoveQuotes quote\">We need to find God, and he cannot be found in noise and restlessness. God is the friend of silence. See how nature - trees, flowers, grass - grows in silence; see the stars, the moon and the sun, how they move in silence... We need silence to be able to touch souls.</div><div class=\"weLoveQuotes author\">Mother Teresa</div>", 
"<div class=\"weLoveQuotes quote\">A bad wife spells a hundred years of bad harvest.</div><div class=\"weLoveQuotes author\">Japanese Proverb</div>", 
"<div class=\"weLoveQuotes quote\">Success is getting what you want. Happiness is liking what you get.</div><div class=\"weLoveQuotes author\">H. Jackson Brown, Jr.</div>", 
"<div class=\"weLoveQuotes quote\">Whenever you find yourself on the side of the majority, it is time to pause and reflect.</div><div class=\"weLoveQuotes author\">Mark Twain</div>", 
"<div class=\"weLoveQuotes quote\">Nobody cares how much you know, until they know how much you care.</div><div class=\"weLoveQuotes author\">Theodore Roosevelt</div>", 
"<div class=\"weLoveQuotes quote\">Real knowledge is to know the extent of one's ignorance.</div><div class=\"weLoveQuotes author\">Confucius</div>", 
"<div class=\"weLoveQuotes quote\">Love is a serious mental disease.</div><div class=\"weLoveQuotes author\">Plato</div>", 
"<div class=\"weLoveQuotes quote\">There are only two tragedies in life: one is not getting what one wants, and the other is getting it.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>", 
"<div class=\"weLoveQuotes quote\">Between men and women there is no friendship possible. There is passion, enmity, worship, love, but no friendship.</div><div class=\"weLoveQuotes author\">Oscar Wilde</div>");

	return $listOfQuotes[$number];
}

function welovequotes_quote_of_the_day() 
{
	return get_quote(date('z'));
}

function welovequotes_random_quote() 
{	
	return get_quote(rand(0, 365));
}

add_shortcode('quoteoftheday', 'welovequotes_quote_of_the_day'); 
add_shortcode('randomquote', 'welovequotes_random_quote'); 

class WeLoveQuotes_QuoteOfTheDayWidget extends WP_Widget
{
  function __construct() 
  {
	parent::__construct('WeLoveQuotes_QuoteOfTheDayWidget', __('Quote of the Day', 'welovequotes_quoteoftheday' ), array ('description' => __( 'Show a daily quote on your website!', 'welovequotes_quoteoftheday')));
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Quote of the day' ) );
    $title = $instance['title'];
	
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <br /><input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
	
    echo welovequotes_quote_of_the_day();
 
    echo $after_widget;
  } 
}

class WeLoveQuotes_RandomQuoteWidget extends WP_Widget
{
  function __construct() 
  {
	parent::__construct('WeLoveQuotes_RandomQuoteWidget', __('Random Quote', 'welovequotes_randomquote' ), array ('description' => __( 'Show a random quote on your website!', 'welovequotes_randomquote')));
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Random Quote' ) );
    $title = $instance['title'];
	
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];

    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
  
    echo welovequotes_random_quote();
	
    echo $after_widget;
  }
}

add_action( 'widgets_init', create_function('', 'return register_widget("WeLoveQuotes_QuoteOfTheDayWidget");') );
add_action( 'widgets_init', create_function('', 'return register_widget("WeLoveQuotes_RandomQuoteWidget");') );
?>