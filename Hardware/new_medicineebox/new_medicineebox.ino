#include <Wire.h>
#include <RtcDS3231.h>
#include <Servo.h>
#include <LiquidCrystal_I2C.h>

RtcDS3231<TwoWire> Rtc(Wire);
LiquidCrystal_I2C lcd(0x27,20,4); // Display  I2C 20 x 4

Servo servo_0,servo_1,servo_2; // 建立Servo物件
unsigned long previousMillis = 0;
const long interval = 51000;

int P1=6; // Button SET MENU'
int P2=7; // Button +
int P3=8; // Button -
int P4=9; // SWITCH Alarm
int P5=11; // alarm menu
int P6=3;
int P7=4;
int P8=5;

#define LED 13
#define buzzer 10

int hourupg;
int minupg;
int yearupg;
int monthupg;
int dayupg;
int menu =0;
int setAll =0;

uint8_t alarmHours1 = 0, alarmMinutes1 = 0, alarmHours2 = 0, alarmMinutes2 = 0, alarmHours3 = 0, alarmMinutes3 = 0;  // Holds the current alarm time


void setup() 
{ 
  servo_0.attach(0);
  servo_1.attach(1);
  servo_2.attach(2);// 伺服馬達的訊號線
  
  pinMode(P1,INPUT_PULLUP);
  pinMode(P2,INPUT_PULLUP);
  pinMode(P3,INPUT_PULLUP);
  pinMode(P4,INPUT_PULLUP);
  pinMode(P5,INPUT_PULLUP);
  pinMode(P6,INPUT_PULLUP);
  pinMode(P7,INPUT_PULLUP);
  pinMode(P8,INPUT_PULLUP);
  
  pinMode(LED,OUTPUT);
  pinMode(buzzer, OUTPUT); // Set buzzer as an output
  
  printAllOff();
  
  lcd.init();
  lcd.backlight();
  lcd.clear();
  Wire.begin();
  Rtc.Begin();

  int menu=0;
} 

void loop() {
  if((digitalRead(P6)== LOW)) 
  {
    servo_0.write(60); 
    delay(180);
    servo_0.write(90);
    delay(1000);
  }

  if((digitalRead(P7)== LOW)) 
  {
    servo_1.write(60); 
    delay(180);
    servo_1.write(90);
    delay(1000);
  }

  if((digitalRead(P8)== LOW)) 
  {
    servo_2.write(60); 
    delay(180);
    servo_2.write(90);
    delay(1000);
  }

  if((digitalRead(P5)== LOW))                                                                                                                                                                     
  {
    DisplaySetHourAll1();
    DisplaySetMinuteAll1();
    DisplaySetHourAll2();
    DisplaySetMinuteAll2();
    DisplaySetHourAll3();
    DisplaySetMinuteAll3();
    lcd.clear();
    lcd.setCursor(5,0);
    lcd.print("ALARM1");
    lcd.setCursor(5,1);
    lcd.print(alarmHours1, DEC);
    lcd.print(":");
    lcd.print(alarmMinutes1, DEC);

    lcd.setCursor(5,2);
    lcd.print("ALARM2");
    lcd.setCursor(5,3);
    lcd.print(alarmHours2, DEC);
    lcd.print(":");
    lcd.print(alarmMinutes2, DEC);

    lcd.setCursor(13,0);
    lcd.print("ALARM3");
    lcd.setCursor(13,1);
    lcd.print(alarmHours3, DEC);
    lcd.print(":");
    lcd.print(alarmMinutes3, DEC);
    delay(1000);
    lcd.clear();
  }

  if (menu==0)
    {
     DisplayDateTime(); // void DisplayDateTime
     Alarm(); // Alarm control
     }
    delay(100);
}

void DisplayDateTime () 
{
// We show the current date and time
  RtcDateTime now = Rtc.GetDateTime();

  lcd.setCursor(0, 2);
  lcd.print("Time : ");
  
  if (now.Hour()<=9)
  {
    lcd.print("0");
  }
  lcd.print(now.Hour(), DEC);
  hourupg=now.Hour();
  lcd.print(":");
  if (now.Minute()<=9)
  {
    lcd.print("0");
  }
  lcd.print(now.Minute(), DEC);
  minupg=now.Minute();
  
  lcd.setCursor(0, 1);
  lcd.print("Date : ");
  if (now.Day()<=9)
  {
    lcd.print("0");
  }
  lcd.print(now.Year(), DEC);
  yearupg=now.Year();
  
  lcd.print("/");
  if (now.Month()<=9)
  {
    lcd.print("0");
  }
  lcd.print(now.Month(), DEC);
  monthupg=now.Month();
  lcd.print("/");
  lcd.print(now.Day(), DEC);
  dayupg=now.Day();
 
  char DOW[][10]={"Sunday   ","Monday   ","Tuesday  ","Wednesday","Thursday ","Friday   ","Saturday "};
  lcd.setCursor(0, 0); 
  lcd.print("Day  : ");
  lcd.print(DOW[now.DayOfWeek()]); // if it appears error in the code, enter the code given below
}

void DisplaySetHourAll1()// Setting the alarm hour
{
  while(digitalRead(P1)==HIGH){

  lcd.clear();

  if(digitalRead(P2)==LOW) //按下按鈕，增加小時
  {
    if(alarmHours1==23)
    {
      alarmHours1=0;
    }
    else
    {
      alarmHours1=alarmHours1+1;
    }
  }
   if(digitalRead(P3)==LOW) //按下按鈕，減少小時
  {
    if(alarmHours1==0)
    {
      alarmHours1=23;
    }
    else
    {
      alarmHours1=alarmHours1-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set HOUR Alarm1:");
  lcd.setCursor(0,1);
  lcd.print(alarmHours1,DEC);
  delay(200);
 }
 delay(200);
}

void DisplaySetMinuteAll1()// Setting the alarm minutes
 {
  while(digitalRead(P1)==HIGH){ 

  lcd.clear();
  if(digitalRead(P2)==LOW) //按下按鈕，增加分鐘
  {
    if (alarmMinutes1==59)
    {
      alarmMinutes1=0;
    }
    else
    {
      alarmMinutes1=alarmMinutes1+1;
    }
  }
   if(digitalRead(P3)==LOW)//按下按紐，減少分鐘
  {
    if (alarmMinutes1==0)
    {
      alarmMinutes1=59;
    }
    else
    {
      alarmMinutes1=alarmMinutes1-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set MIN. Alarm1:");
  lcd.setCursor(0,1);
  lcd.print(alarmMinutes1,DEC);
  delay(200);
 }
 delay(200);
}

void DisplaySetHourAll2()// Setting the alarm hour
{
  while(digitalRead(P1)==HIGH){

  lcd.clear();

  if(digitalRead(P2)==LOW)
  {
    if(alarmHours2==23)
    {
      alarmHours2=0;
    }
    else
    {
      alarmHours2=alarmHours2+1;
    }
  }
   if(digitalRead(P3)==LOW)
  {
    if(alarmHours2==0)
    {
      alarmHours2=23;
    }
    else
    {
      alarmHours2=alarmHours2-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set HOUR Alarm2:");
  lcd.setCursor(0,1);
  lcd.print(alarmHours2,DEC);
  delay(200);
 }
 delay(200);
}

void DisplaySetMinuteAll2()// Setting the alarm minutes
 {
  while(digitalRead(P1)==HIGH){ 

  lcd.clear();
  if(digitalRead(P2)==LOW)
  {
    if (alarmMinutes2==59)
    {
      alarmMinutes2=0;
    }
    else
    {
      alarmMinutes2=alarmMinutes2+1;
    }
  }
   if(digitalRead(P3)==LOW)
  {
    if (alarmMinutes2==0)
    {
      alarmMinutes2=59;
    }
    else
    {
      alarmMinutes2=alarmMinutes2-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set MIN. Alarm2:");
  lcd.setCursor(0,1);
  lcd.print(alarmMinutes2,DEC);
  delay(200);
 }
 delay(200);
 }

void DisplaySetHourAll3()// Setting the alarm hour
{
  while(digitalRead(P1)==HIGH){

  lcd.clear();

  if(digitalRead(P2)==LOW)
  {
    if(alarmHours3==23)
    {
      alarmHours3=0;
    }
    else
    {
      alarmHours3=alarmHours3+1;
    }
  }
   if(digitalRead(P3)==LOW)
  {
    if(alarmHours3==0)
    {
      alarmHours3=23;
    }
    else
    {
      alarmHours3=alarmHours3-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set HOUR Alarm3:");
  lcd.setCursor(0,1);
  lcd.print(alarmHours3,DEC);
  delay(200);
 }
 delay(200);
}

void DisplaySetMinuteAll3()// Setting the alarm minutes
 {
  while(digitalRead(P1)==HIGH){ 

  lcd.clear();
  if(digitalRead(P2)==LOW)
  {
    if (alarmMinutes3==59)
    {
      alarmMinutes3=0;
    }
    else
    {
      alarmMinutes3=alarmMinutes3+1;
    }
  }
   if(digitalRead(P3)==LOW)
  {
    if (alarmMinutes3==0)
    {
      alarmMinutes3=59;
    }
    else
    {
      alarmMinutes3=alarmMinutes3-1;
    }
  }
  lcd.setCursor(0,0);
  lcd.print("Set MIN. Alarm3:");
  lcd.setCursor(0,1);
  lcd.print(alarmMinutes3,DEC);
  delay(200);
 }
 delay(200);
 }

void printAllOn1(){
  lcd.setCursor(0,3);
  lcd.print("Alarm1: on  ");
}

void printAllOn2(){
  lcd.setCursor(0,3);
  lcd.print("Alarm2: on  ");
}

void printAllOn3(){
  lcd.setCursor(0,3);
  lcd.print("Alarm3: on  ");
}

void printAllOff() {
  lcd.setCursor(0, 3);
  lcd.print("Alarm: Off  ");  
}

void Alarm(){
   if(digitalRead(P4)== LOW) //透過按鈕判斷現在啟用哪個鬧鐘
  {
   setAll=setAll+1;
  }
  if (setAll==0)
    {
     printAllOff();
     noTone (buzzer);
     digitalWrite(LED,LOW);
     }
  if (setAll==1)
    {
     printAllOn1();    
     RtcDateTime now = Rtc.GetDateTime();
     unsigned long currentMillis = millis();
     if ( now.Hour() == alarmHours1 && now.Minute() == alarmMinutes1)//判斷現在時間跟設定時間是否相等
        {
         lcd.noBacklight();
         RtcDateTime now = Rtc.GetDateTime();
         digitalWrite(LED,HIGH);
         tone(buzzer,880); //play the note "A5" (LA5)
         delay (300);
         tone(buzzer,698); //play the note "F6" (FA5)     
         delay(300);    
         lcd.backlight();
         delay(300);
          if (currentMillis - previousMillis >= interval) {//馬達甚麼時候轉
            servo_0.write(60); 
            delay(150);
            servo_0.write(90);
            delay(1000);
            previousMillis = currentMillis;
          }
        }
    else{
         noTone (buzzer);
         digitalWrite(LED,LOW);
        }
      
    } 

    if (setAll==2)
    {
     printAllOn2();    
  
     RtcDateTime now = Rtc.GetDateTime();
     unsigned long currentMillis = millis();
     if ( now.Hour() == alarmHours2 && now.Minute() == alarmMinutes2 )
        {
         lcd.noBacklight();
         RtcDateTime now = Rtc.GetDateTime();
         digitalWrite(LED,HIGH);
         tone(buzzer,880); //play the note "A5" (LA5)
         delay (300);
         tone(buzzer,698); //play the note "F6" (FA5)
         lcd.backlight();
         delay(300);
        if (currentMillis - previousMillis >= interval) {
         servo_1.write(60); 
         delay(250);
         servo_1.write(90);
         delay(1000);
         previousMillis = currentMillis;
         }
        }
    else{
         noTone (buzzer);
         digitalWrite(LED,LOW);
        }
    } 

  if (setAll==3)
    {
     printAllOn3();    
  
     RtcDateTime now = Rtc.GetDateTime();
     unsigned long currentMillis = millis();
     if ( now.Hour() == alarmHours3 && now.Minute() == alarmMinutes3 )
        {
         lcd.noBacklight();
         RtcDateTime now = Rtc.GetDateTime();
         digitalWrite(LED,HIGH);
         tone(buzzer,880); //play the note "A5" (LA5)
         delay (300);
         tone(buzzer,698); //play the note "F6" (FA5)
         lcd.backlight();
         delay(300);
         if (currentMillis - previousMillis >= interval) {
         servo_2.write(60); 
         delay(250);
         servo_2.write(90);
         delay(1000);
         previousMillis = currentMillis;
         }
        }
    else{
         noTone (buzzer);
         digitalWrite(LED,LOW);
        }
    }
    
  if (setAll==4)
    {
     setAll=0;
    }
    delay(200);
}
