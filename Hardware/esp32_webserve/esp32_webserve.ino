#include <WiFi.h>
#include <DHT.h>
#define DHTTYPE DHT11
#define DHTPIN  15
#define FORCE1 36
#define FORCE2 34
#define FORCE3 35
#define FORCE_OUT 32

// Replace with your network credentials
const char* ssid = "milkcoco";
const char* password = "a8222820";

// Set web server port number to 80
WiFiServer server(80);
DHT dht(DHTPIN, DHTTYPE, 11);

// Variable to store the HTTP request
String header;
float humidity, temp_f;   // 從 DHT-11 讀取的值
String tempe1="";      // 顯示溫度的字串
String humid1="";    // 顯示濕度的字串
int fsr1,fsr2,fsr3,fsr_out;
String FSR1="";
String FSR2="";
String FSR3="";
String FSR_OUT="";

unsigned long currentTime = millis();
unsigned long previousTime = 0; 
const long timeoutTime = 2000;

void setup() {
  Serial.begin(115200);
  dht.begin();

  // Connect to Wi-Fi network with SSID and password
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  // Print local IP address and start web server
  Serial.println("");
  Serial.println("WiFi connected.");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
  server.begin();
}

void loop(){
  unsigned long currentTime = millis();

  if(currentTime - previousTime >= timeoutTime) {
    // 將最後讀取感測值的時間紀錄下來 
    previousTime = currentTime;   

    // 讀取溫度大約 250 微秒!
    humidity = dht.readHumidity();          // 讀取濕度(百分比)
    temp_f = dht.readTemperature(true);     // 讀取溫度(華氏)

    fsr1 = analogRead(FORCE1);
    fsr2 = analogRead(FORCE2);
    fsr3 = analogRead(FORCE3);
    fsr_out = analogRead(FORCE_OUT);

    int fsr1,fsr2,fsr3,fsr_out;
    String FSR1="";
    String FSR2="";
    String FSR3="";
    String FSR_OUT="";

    if (isnan(humidity) || isnan(temp_f)) {
       Serial.println("Failed to read from DHT sensor!");
       return;
    }

    if (isnan(fsr1)&& isnan(fsr2) && isnan(fsr3) && isnan(fsr_out)) {
       Serial.println("Failed to read from FSR sensor!");
       return;
    }
   }

   tempe1="Temperature:"+String((int)(temp_f-32)*5/9)+"oC";   
   humid1="Humidity:"+String((int)humidity)+"%";
   FSR1 = String((int)fsr1);
   FSR2 = String((int)fsr2);
   FSR3 = String((int)fsr3);
   FSR_OUT = String((int)fsr_out);

   Serial.println(tempe1);
   Serial.println(humid1);
   Serial.println(fsr1);
   Serial.println(fsr2);
   Serial.println(fsr3);
   Serial.println(fsr_out);
   delay(10000);
    
  WiFiClient client = server.available();   // Listen for incoming clients

  if (client) {                             // If a new client connects,
    currentTime = millis();
    previousTime = currentTime;
    Serial.println("New Client.");          // print a message out in the serial port
    String currentLine = "";                // make a String to hold incoming data from the client
    while (client.connected() && currentTime - previousTime <= timeoutTime) {  // loop while the client's connected
      currentTime = millis();
      if (client.available()) {             // if there's bytes to read from the client,
        char c = client.read();             // read a byte, then
        Serial.write(c);                    // print it out the serial monitor
        header += c;
        if (c == '\n') {                    // if the byte is a newline character
          // if the current line is blank, you got two newline characters in a row.
          // that's the end of the client HTTP request, so send a response:
          if (currentLine.length() == 0) {
            // HTTP headers always start with a response code (e.g. HTTP/1.1 200 OK)
            // and a content-type so the client knows what's coming, then a blank line:
            client.println("HTTP/1.1 200 OK");
            client.println("Content-type:text/html");
            client.println("Connection: close");
            client.println();
            
            // Display the HTML web page
            client.println("<!DOCTYPE html><html>");
            client.println("<head><meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
            client.println("<Meta http-equiv=\"ReFresh\" Content=\"20\">"); //每20秒自動刷新頁面
            client.println("<link rel=\"icon\" href=\"data:,\">");
            // CSS to style the on/off buttons 
            // Feel free to change the background-color and font-size attributes to fit your preferences
            client.println("<style>html { font-family: Helvetica; display: inline-block; margin: 0px auto; text-align: center;}");
            client.println("text-decoration: none; font-size: 30px; margin: 2px; cursor: pointer;}");
            client.println("</style></head>");
            
            // Web Page Heading
            client.println("<body onload='javascript:submitForm()'><h1>ESP32 Web Server</h1>");
            if (humidity >= 75) {
              client.println("<font size=5>""<p>" "pill box envitonment too humid" "</p>""</font>"); //現在藥盒太濕
              client.println("<p>" + tempe1 + "</p>"); //顯示溫度
              client.println("<p>" + humid1 + "</p>"); //顯示濕度
            }
            else
            {
              client.println("<font size=5>""<p>" "pill box environment stable" "</p>""</font>");
            }
            if(fsr1 < 1000)//判斷藥物重量是否太少
            {
             client.println("<font size=5>""<p>" "medicament tray one almost empty" "</p></font>");
             client.println("<p>" + FSR1 + "</p>"); //1號藥盤剩餘重量
            }
            else
            {
              client.println("<font size=5>""<p>" "medicament tray one stock ok" "</p>""</font>");
            }
            if(fsr2 < 1000)//判斷藥物重量是否太少
            {
              client.println("<font size=5>""<p>" "medicament tray two almost empty" "</p></font>");
              client.println("<p>" + FSR2 + "</p>");//2號藥盤剩餘重量
            }
            else
            {
              client.println("<font size=5>""<p>" "medicament tray two stock ok" "</p>""</font>");
            }
             if(fsr3 < 1000)//判斷藥物重量是否太少
            {
              client.println("<font size=5>""<p>" "medicament tray three almost empty" "</p></font>");
              client.println("<p>" + FSR3 + "</p>");//3號藥盤剩餘重量
            }
            else
            {
              client.println("<font size=5>""<p>" "medicament tray three stock ok" "</p>""</font>");
            }
            if(fsr_out > 0)//確認出藥口是否有藥品
            {
              client.println("<font size=5>""<p>" "medicinee give" "</p></font>");
            }
            else
            {
              client.println("<font size=5>""<p>" "patient had eat medicinee" "</p></font>");
            }
            //將資料傳送到網頁
            client.println("<form id='humid1' id='FSR1' id='FSR2' id='FSR3' id='FSR_OUT' method='GET' action='https://7a39-61-230-162-98.jp.ngrok.io/linebot/linebotpush.php'>");
            client.println("<input type='hidden' name='humid1' value= "+humid1+">");
            client.println("<input type='hidden' name='FSR1' value= "+FSR1+">");
            client.println("<input type='hidden' name='FSR2' value= "+FSR2+">");
            client.println("<input type='hidden' name='FSR3' value= "+FSR3+">");
            client.println("<input type='hidden' name='FSR_OUT' value=1," +FSR_OUT+">");       

            client.println("</form>");   
            //將資料自動推送到網頁
            client.println("<script type='text/javascript'>"); 
            
            client.println("document.getElementById('humid1').submit()");
            client.println("document.getElementById('FSR1').submit()");
            client.println("document.getElementById('FSR2').submit()");
            client.println("document.getElementById('FSR3').submit()");
            client.println("document.getElementById('FSR_OUT').submit()");

            client.println("</script>");
            
            client.println("</body></html>");
            
            // The HTTP response ends with another blank line
            client.println();
            // Break out of the while loop
            break;
          } else { // if you got a newline, then clear currentLine
            currentLine = "";
          }
        } else if (c != '\r') {  // if you got anything else but a carriage return character,
          currentLine += c;      // add it to the end of the currentLine
        }
      }
    }
    // Clear the header variable
    header = "";
    // Close the connection
    client.stop();
    Serial.println("Client disconnected.");
    Serial.println("");
  }
}
