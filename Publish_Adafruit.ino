// All text above must be included in any redistribution.

/************************** Configuration ***********************************/

// edit the config.h tab and enter your Adafruit IO credentials
// and any additional configuration needed for WiFi, cellular,
// or ethernet clients.
#include "config.h"

/************************ Example Starts Here *******************************/

const int HUM_PIN = 39; //humidity sensor
const int WATER_PIN = 36; //water level sensor
const int LED_PIN = 34;

const int maxValue = 4096;
const int minValue = 0;

int HumValue = 0;
int WaterValue = 0;

// set up the 'analog' feed
AdafruitIO_Feed *analog = io.feed("Humidity");
AdafruitIO_Feed *analog1 = io.feed("Water Level");
AdafruitIO_Feed *counter = io.feed("Order");

void setup() {

  // start the serial connection
  Serial.begin(115200);

  // wait for serial monitor to open
  while(! Serial);

  // connect to io.adafruit.com
  Serial.print("Connecting to Adafruit IO");
  io.connect();

  counter->onMessage(handleMessage);

  // wait for a connection
  while(io.status() < AIO_CONNECTED) {
    Serial.println(io.statusText());
    delay(500);
  }

  // we are connected
  Serial.println();
  Serial.println(io.statusText());
}

void loop() {

  // io.run(); is required for all sketches.
  // it should always be present at the top of your loop
  // function. it keeps the client connected to
  // io.adafruit.com, and processes any incoming data.
  io.run();

  HumValue = MAP(HUM_PIN, minValue, maxValue);
  Serial.println(HumValue);

  WaterValue = MAP(WATER_PIN, minValue, maxValue);
  Serial.println(WaterValue);
  
  // save the current state to the analog feed
  Serial.print("sending -> ");
  Serial.println(HumValue);
  analog->save(HumValue);
  
  Serial.print("sending -> ");
  Serial.println(WaterValue);
  analog1->save(WaterValue);


  // wait three seconds (1000 milliseconds == 1 second)
  //
  // because there are no active subscriptions, we can use delay()
  // instead of tracking millis()
  delay(5000);
}

int MAP(int PIN, int MIN, int MAX)
{
  int mapValue;
  mapValue = analogRead(PIN);
  mapValue = map(mapValue, MIN, MAX, 0, 100); //gives a value to the sensor value between 0(corresponding
  //to the minValue) and 100 (corresponding to the maxValue)
  mapValue = constrain(mapValue, 0, 100); //in case sensorValue is outside the range seen during calibration
  return mapValue;
}

// this function is called whenever a 'counter' message
// is received from Adafruit IO. it was attached to
// the counter feed in the setup() function above.
void handleMessage(AdafruitIO_Data *data) {

  Serial.print("received <- ");
  Serial.println(data->value());

}
