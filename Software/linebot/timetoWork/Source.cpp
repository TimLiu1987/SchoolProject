#define _CRT_SECURE_NO_WARNINGS

#include <iostream>
#include <string>
#include <stdio.h>
#include <chrono>
#include <thread>
using namespace std;
using namespace std::this_thread; // sleep_for, sleep_until
using namespace std::chrono; // nanoseconds, system_clock, seconds

int main() {
    time_t now = time(0);

    tm* ltm = localtime(&now);



    int nowMin = ltm->tm_min;
    int nowHour = ltm->tm_hour;
    while (1) {
        now = time(0);
        ltm = localtime(&now);
        if (nowMin != ltm->tm_min) {
            system("php notify.php");
            nowMin = ltm->tm_min;
        }
        cout << "now min = " << ltm->tm_min << endl;
        sleep_for(seconds(5));
    }
    return 0;
}