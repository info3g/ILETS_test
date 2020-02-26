<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class DobController extends Controller
{
    private $answers= array(
    "monday"=>"You have a good memory; you are soft spoken, but you are also very whimsical . You are very sensitive and emotional, and are prone to get nervous easily . You love to spend time with your family, relatives and close friends . You love peace and you make peace. You are always the pacifier when quarrels take place among your close ones . You are most likely to be involved in a skill-based occupation, and you are very business minded . Monday born women might suffer from anemia related problems, weakness, insomnia and dizziness.You ought to take a lot of vitamins and exercise regularly in order to stay fit . Monday born men love food and are mostly misers. But they also lead disciplined lives and are immensely successful in their jobs . Girls born on a Monday grow up to be very good wives and mothers.They are loving and caring and take good care of their close ones .",
    "tuesday"=>"You are very active, lively and have a vivacious demeanor. You have warrior-like qualities . You are brave and serious in your work, and will always have people to help you out . You worry a lot and the more you worry, the more problems you attract in your life. You should learn to let go and relax; and lead a hassle free life. Simplify your living and life will become more endearing . You are overtly materialistic. Though your taste in material possessions is quite good, but sometimes you overindulge and end up buying more things than you need—be it clothes or anything else. You should learn to save money . Though you ask other’s opinions a lot, you eventually do what you think is right. So instead of asking around too much, spend time thinking on your own and weighing the pros and cons on your own accord because in the end, you will take your own decision . You are very straight-forward, and often do not think before you speak. This results in many people ending up in misunderstanding you . You are hardworking but also very sensitive which makes you somewhat difficult to deal with .",
    "wednesday"=>"You are quite witty and have a mind curved specially for business . You are not very organized in your work and have a cluttered thought process as well . You are not much concerned about your looks or your surroundings—you are mostly simple minded . You are curious by nature; you ask a lot of questions and seek to communicate. You are very active when it comes to interacting with others and exchanging ideas . You are satisfied with your life most of the time and are easily contented by what you have . You are efficient in your work, and are likely to do well in supervisory positions . You should keep your temper in check as you are by birth short tempered which comes in the way of your achieving success in life and maintaining good relationships . Women born on Wednesdays, especially after 6 PM, however exhibit different characteristics: You are materialistic, highly intelligent and sometimes, sly. You always do things which will give you back something in return .",
    "thursday"=>"You are wise, optimistic and highly understanding; you are respected a lot and attract plenty of attention wherever you go . You have leadership qualities and are likely to end up in high positions wherever you work and in society as well . You work hard and carve your own path towards success. You like to lead an independent life . You are very stubborn and will have difficulty in having many true friends in life because of your inability to accept healthy criticism. Also, you are very straightforward and do not think much before speaking which may offend people . You are easily bored and always require something or the other to keep you occupied. You also love to travel a lot and cannot sit at one place for long . You are well behaved and treat people with respect, however if someone annoys you or mistreats you, you hold grudge and also think of taking revenge . Though you are intelligent and conscientious, you have a somewhat unusual character and an irritable temperament that makes you difficult for others to cope with .",
    "friday"=>"You are the harbinger of peace, love, beauty and pleasure. The creative fields like music, painting, artistry and acting attract you a lot . You are generally happy-go-lucky but sensitive when it comes to relationships. You do not take heartbreaks well and if anything or anyone makes you sad, you mourn over it for too long . If you are a woman, you have a high emotional quotient and thus have many friends around you. You are also very possessive, quick-witted and business minded . If you are a man, you are very popular among women and are munificent in nature. But your relationship with your family members is thrifty. You love travelling overseas . You do not fall ill often, but when you do, it is either something very serious or something that will take a very long time to recover from . You have an intrinsic intuition about things which you should follow to keep out of harm’s way . You are spiritual by nature and have worldly wisdom which makes you wiser than people even elder to you .",
    "saturday"=>"You are generally serious and have a good sense of responsibility which makes you a very trusted person . You are prone to worrying too much and get sad often suddenly by recalling past events . You are very intelligent, almost perfectionist, and would do extremely well in any kind of business . You like to maintain a high standard of living and have a style of your own. The clothes you wear, you overall get-up and everything you do appears to have been planned and purposeful even when it is not . You are prone to be rebellious but sometimes it might be just for the sake of it or without good reason . You are somewhat difficult to control because in the end you do what you think is right and what others say do not matter much to you . You are not only stubborn but you also do not trust many people—even if they are your close friends or colleagues. You weigh too much before making friends .",
    "sunday"=>"You have a positive attitude towards life and are generous in nature.You are also very trustworthy . You are most likely to be an introvert and have very few friends.You are very suspicious and do not trust others much . You are very sensitive and are often too moved by somebody else’s comment and you think over it for too long . You are a thinker, but sometimes you might get carried away and lose focus from reality.You also have a tendency to procrastinate . You are very helpful in nature but are also short tempered which might hamper your relationship with others . You are independent and love to help those in need.You are also stubborn in nature . Due to your stubborn nature you find it hard to work amicably with others and find difficulty in dealing with situations where some compromise and conformation is required. You ought to change your attitude otherwise you might find it hard to survive in your workplace .");
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('dob.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $userdate=$request->birthdate;

        $usermonth=$request->birthmonth;
        $useryear=$request->birthyear;

        $input = $useryear."-".$usermonth."-".$userdate;
        $dt = new \DateTime($input);
        $day = $dt->format('l');
        $day = strtolower($day);            
        return redirect()->route('dob.show',$day);        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($day)
    {        
        $this->answers;     
        $answer=$this->answers[$day]; 
        $data = ['answer'=>$answer,'day'=>$day];      
        return view('dob.show',$data);
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
