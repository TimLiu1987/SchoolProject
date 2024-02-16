#include <WiFi.h>
#include <WiFiClient.h>
#include <TridentTD_LineNotify.h>
#include <DHT.h>
#define DHTTYPE DHT11
#define DHTPIN  15
#define FORCE1 36
#define FORCE2 34
#define FORCE3 35
#define FORCE_OUT 32
#define LINE_TOKEN "+/5N813XXTcoB4UZrCh8uBHsnkIcqvUbqp4MCFdvYbUET4fFQ0fltd3yC6ny/C0Esz8BqYLUIc9H4ojMxBqKezh9Qt5OCwRnG2Y0XslUyEtYOA4mhucQAKaVQS8td72UvYVy5LTIH3Jczvp0zpCsFwdB04t89/1O/w1cDnyilFU="

unsigned long previousMillis1 = 0;
const long interval1 = 120000;
unsigned long previousMillis2 = 0;        // will store last temp was read
const long interval2 = 2000;              // interval at which to read sensor

unsigned long currentMillis1 = millis();
unsigned long currentMillis2 = millis();

// 設定網路基地台SSID跟密碼
char ssid[] = "milkcoco";
char password[] = "a8222820";

DHT dht(DHTPIN, DHTTYPE, 11);    // 11 works fine for ESP32

int fsr1,fsr2,fsr3,fsr_out;
String FSR1="";
String FSR2="";
String FSR3="";
String FSR_OUT="";
float humidity, temp_f;   // 從 DHT-11 讀取的值
String tempe1="";      // 顯示溫度的字串
String humid1="";    // 顯示濕度的字串

const char* host = "maker.ifttt.com";
const int httpPort = 80;
 
void setup(void)
{
  Serial.begin(115200);  // 設定速率 感測器
  dht.begin();           // 初始化

  WiFi.mode(WIFI_STA);
  // 連接無線基地台
  WiFi.begin(ssid, password);
  Serial.print("\n\r \n\rWorking to connect");

  // 等待連線，並從 Console顯示 IP
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}
 
void loop(void)
{
  // 量測間等待至少 2 秒
  unsigned long currentMillis2 = millis();
 
  if(currentMillis2 - previousMillis2 >= interval2) {
    // 將最後讀取感測值的時間紀錄下來 
    previousMillis2 = currentMillis2;   

    // 讀取溫度大約 250 微秒!
    humidity = dht.readHumidity();          // 讀取濕度(百分比)
    temp_f = dht.readTemperature(true);     // 讀取溫度(華氏)

    fsr1 = analogRead(FORCE1);
    fsr2 = analogRead(FORCE2);
    fsr3 = analogRead(FORCE3);
    fsr_out = analogRead(FORCE_OUT);
    
    // 檢查是否為空值
    if (isnan(humidity) || isnan(temp_f)) {
       Serial.println("Failed to read from DHT sensor!");
       return;
    }
    if (isnan(fsr1)&& isnan(fsr2) && isnan(fsr3) && isnan(fsr_out)) {
       Serial.println("Failed to read from FSR sensor!");
       return;
    }
  }

  // 除錯用
  tempe1="Temperature:"+String((int)(temp_f-32)*5/9)+"oC";   
  humid1="Humidity:"+String((int)humidity)+"%";
  FSR1 = String((int)fsr1)+"g  pill1";
  FSR2 = String((int)fsr2)+"g  pill2";
  FSR3 = String((int)fsr3)+"g  pill3";
  FSR_OUT = String((int)fsr_out)+"g  pill_out";

  Serial.println(tempe1);
  Serial.println(humid1);
  Serial.println(FSR1);
  Serial.println(FSR2);
  Serial.println(FSR3);
  Serial.println(FSR_OUT);

  WiFiClient client;
  Serial.print("connecting to ");
  Serial.println(host);
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }

  Serial.println(LINE.getVersion());//傳送提醒到Line
 if(humidity > 100)
 {
  LINE.setToken(LINE_TOKEN);
  LINE.notify("藥盒過於潮濕\n" + tempe1 + " ；" + humid1);
 }

  if(fsr1 < 0)
  {
    LINE.setToken(LINE_TOKEN);
    LINE.notify("一號藥盤快沒藥了\n" + fsr1 );
  }

  if(fsr2 < 0)
  {
    LINE.setToken(LINE_TOKEN);
    LINE.notify("二號藥盤快沒藥了\n" + fsr2 );
  }

  if(fsr3 < 0)
  {
    LINE.setToken(LINE_TOKEN);
    LINE.notify("三號藥盤快沒藥了\n" + fsr3 );
  }
  delay(10000);
  if(fsr_out > 0)
  {
    LINE.setToken(LINE_TOKEN);
    LINE.notify("未取藥\n" + fsr_out );
  }
  else
  {
    LINE.setToken(LINE_TOKEN);
    LINE.notify("已取藥\n" + fsr_out );
  }
  
}
