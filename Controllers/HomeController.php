<?php

namespace App\Http\Controllers;

// use App\Home;
use Illuminate\Http\Request;

class HomeController extends Controller {
    private $list1 = [
            'appletree'=>'Dec 23 to Jan 1',
            'firtree'=>'Jan 2 to Jan 11',
            'elmtree'=>'Jan 12 to Jan 24',
            'cypresstree'=>'Jan 25 to Feb 3',
            'poplartree'=>'Feb 4 to Feb 8',
            'cedartree'=>'Feb 9 to Feb 18',
            'pinetree'=>'Feb 19 to Feb 28',
            'weepingwillowtree'=>'Mar 1 to Mar 10',
            'limetree'=>'Mar 11 to Mar 20',
            'oaktree'=>'Mar 21'
        ];
    private $list2 = [
            'hazelnuttree'=>'Mar 22 to Mar 31',
            'rowantree'=>'Apr 1 to Apr 10',
            'mapletree'=>'Apr 11 to Apr 20',
            'walnuttree'=>'Apr 21 to Apr 30',
            'poplartree'=>'May 1 to May 14',
            'chestnuttree'=>'May 15 to May 24',
            'ashtree'=>'May 25 to June 3',
            'hornbeamtree'=>'June 4 to June 13',
            'figtree'=>'June 14 to June 23',
            'birchtree'=>'June 24'
        ];
    private $list3 =[
            'appletree'=>'June 25 to Jul 4',
            'firtree'=>'Jul 5 to Jul 14',
            'elmtree'=>'Jul 15 to Jul 25',
            'cypresstree'=>'Jul 26 to Aug 04',
            'poplartree'=>'Aug 5 to Aug 13',
            'cedartree'=>'Aug 14 to Aug 23',
            'pinetree'=>'Aug 24 to Sep 2',
            'weepingwillowtree'=>'Sep 3 to Sep 12',
            'limetree'=>'Sep 13 to Sep 22',
            'olivetree'=>'Sep 23'
        ];
    private $list4 =[
            'hazelnuttree'=>'Sep 24 to Oct 3',
            'rowantree'=>'Oct 4 to Oct 13',
            'mapletree'=>'Oct 14 to Oct 23',
            'walnuttree'=>'Oct 24 to Nov 11',
            'chestnuttree'=>'Nov 12 to Nov 21',
            'ashtree'=>'Nov 22 to Dec 1',
            'hornbeamtree'=>'Dec 2 to Dec 11',
            'figtree'=>'Dec 12 to Dec 21',            
            'beechtree'=>'Dec 22'           
        ];
    private $answers = [
            'appletree'=>'Apple tree stands for youthfulness, pleasure, passion and ardour. You are very much like the apple tree and the apple fruit-Happy, bouncy, shiny and full of life. When you blossom, you bring happiness and joy to everyone around you. You are also extremely kind and helpful to others and this is innate to you and not something that you force yourself to do or let others force you into.',

            'ashtree'=>'Ash tree signifies compassion, deep thinking and spiritedness. Conflicting characteristics define you. Your spirited behaviour does not necessarily bring out your compassionate and your profound thinking. People think you are impulsive and many a times do so at their own peril. You are honest in every relationship and give it your all.',

            'beechtree'=>'Beech tree signifies flexibility, tranquillity and resourcefulness. You live for the moment and for the day and are more than willing to face challenges head on. It is important that you look your best at most times. You set goals, try to achieve each one of them and are motivated. You can change according to the circumstances and this will keep you going even in difficult situations. You long for peace around you. ',

            'birchtree'=>'Birch tree signifies novelty, drive and acuity. You are a discerner and come very close to becoming a people reader. You are full of live and take great pleasure in meeting and getting to know new people. You also like and lead a pretty simple life and do not want to complicate it with too many things.',

            'cedartree'=>'Cedar tree signifies health, confidence and beauty. You are multi-talented and can impress just about anyone. Your body is as beautiful as your mind. Honesty and faith becomes you and you cannot lie even when your life is at stake.  You love the good life and strive hard to get there.',

            'chestnuttree'=>'Chestnut tree signifies fairness, scrupulousness and tolerance. You want things to be right and would go the extra mile to see there is no crookedness surrounding you. When it comes to fashion, you have a unique style and change is always constant. No one can really be sure of what you will come up with, be it clothes or ideas.',

            'cypresstree'=>'Cypress tree stands for unselfish behaviour, strength of character and adaptable nature. You are quite the optimist and never let anything pull you down. You have fervour for life and want to live it to the fullest. You are also an amazing lover and giver and make people very happy to know you and be with you.',

            'elmtree'=>'Elm tree stands for happiness, self-awareness and insight. You are a positive influence on others with the way you live. You believe in things and never give up hope. You are also a fashionable dresser who can even make rags look cool. Your charm and humour will make you the first choice for any party or social gathering.',

            'figtree'=>'Fig tree signifies health, elegance and fertility.  You ar a very generous person. You are kind, loving and expect the same from everyone you meet too, leading to many disappointments in life. Although you are good at what you do, you do not reach your optimum levels because of your laziness.',

            'firtree'=>'Fir tree signifies reliability, strength and dependability. You care a lot for others and it doesnot matter even if they are not closely acquainted with you. You are quite mature in the way you think and this applies to all facets of your life. You not only dream of a better life and world but your industriousness helps you make your dreams become a reality.',

            'hazelnuttree'=>'Hazelnut tree signifies Intelligence, efficiency and liveliness. Brainy, efficient and also playful, you are a dream combination of all desirable qualities. You are a complete charmer too to add to your already attractive nature. Your perceptive nature lets you connect with people with a lot of ways many do not understand.',

            'hornbeamtree'=>'Hornbeam tree signifies obligation, complexity and carefulness. You are complex and sophisticated and very responsible. Even though people are put off by your sophistication, you are quite easily accessible and are open to people. You like comfort and you work hard to make sure you get it in your life.',

            'limetree'=>'Lime tree signifies movement, amity and sacrifice.  You are an active person, full of exuberance and life. You bring cheer to most people you see and also have a calming effect on some. You believe in love and sacrifice and never think that these too can be old fashioned. You always stand by people you believe in and it is not confined to just your family and friends. You have a 
            great color coordination when it comes to fashion.',
            'mapletree'=>'Maple tree signifies capacity, exceptionality and pragmatism. You are as practical as they come. This coupled with your independent nature makes you a formidable force to be reckoned with. You analyse a situation, never let emotions dictate terms and go ahead to get what you want. Your life is full of promise and potential.',

            'oaktree'=>'Oak tree signifies strength, solid nature and never say die attitude. You value your freedom more than anything else, but are also responsible and never let your pursuits hurt anyone else. A practical thinker, you are always full of sensible solutions to anything that might crop up suddenly. You are kind and want peace and harmony which makes you a little bit of an idealist.',

            'olivetree'=>'Olive tree signifies concord, astuteness and craving. You are quite open with your emotions and do not really care about how you will be looked at. You are very street smart and can easily turn any situation to your benefit. You set new trends in life and make people want to follow you. You are also a good judge of character and this will take you places.',

            'pinetree'=>'Pine tree signifies vivacity, inventiveness and life. You are passionate, but are very susceptible to distractions. This makes you not bale to finish things at times. You are always trying to improve your life and can come up with many ways to keep you and others interested. You like sharing whatever you have with others and get along fabulously with like-minded people.',

            'poplartree'=>'Poplar tree signifies fortification, valour and consistency.  You are brave and can stand up to anything. You are also very creative and spent your time in artistic pursuits. You are not a bid follower of fashion but are always well dressed with comfort being the priority. You are mostly successful in everything you do and face everything head on.',

            'rowantree'=>'Rowan tree signifies prudence, sensitivity and novelty. You do not give in to impulsive behaviour. You exercise prudence in relationships, work and finance. You are sensitive to the smallest of disturbances, but it also makes you a caring person who thinks of others sensibilities. You also have a very forgiving nature and cannot be mad at someone for long.',

            'walnuttree'=>'Walnut tree signifies intelligence, desire and sureness. You are intelligent, ambitious and possess a thirst for bigger things in life. You are spontaneous and given to bouts of aggressive behaviour. Although you love unconditionally, you are prone to jealousy which will ruin many a relationship for you. You need to be careful in handling your negative emotions.',

            'weepingwillowtree'=>'Weeping Willow tree signifies profundity, visions and a reflective nature. You think far ahead in any situation. You are a profound thinker and would like to analyse a situation before you act on it. You also reflect on your actions and how other people react to you. This makes you a good reader of people and also keeps you in good stead.',            
        ];
    
    public function index() {
        $data_nothing = ['list1'=>$this->list1,'list2'=>$this->list2,'list3'=>$this->list3,'list4'=>$this->list4];        
        return view('home.index')->with('data',$data_nothing);
    }
    
    public function show($name) {   
        $l1 = $l2 = $l3 = $l4 = '';        
        if(array_key_exists($name,$this->list1))
            $l1 = $this->list1[$name];
        if(array_key_exists($name,$this->list2))
            $l2 = $this->list2[$name];
        if(array_key_exists($name,$this->list3))
            $l3 = $this->list3[$name];
        if(array_key_exists($name,$this->list4))
            $l4 = $this->list4[$name];
        $dates = ['l1'=>$l1,'l2'=>$l2,'l3'=>$l3,'l4'=>$l4];
        $result_dates = [];
        
        foreach ($dates as $date) {
            if(!empty($date))
                array_push($result_dates,$date);
        }        
        if(count($result_dates) > 1){
            $final_date = implode(', ', $result_dates);            
        }
        else{
            $final_date = $result_dates[0];
        }
                
        $data = ['name'=>$name,'answer'=>$this->answers[$name],'final_date'=>$final_date];
        return view('home.show')->with('data',$data);
    }
}
