


var flag = false;
var fill = false;
window.onload = getMyLocation; //Вызываем функцию, которую создадим чуть ниже, она срабатывает сразу же после загрузки нашего сайта.

function getMyLocation () { //собственно наша функция для определения местоположения
	if (navigator.geolocation) { //для начала надо проверить, доступна ли геолокация, а то еще у некоторых браузеры то древние. Там о таком и не слышали.
		navigator.geolocation.getCurrentPosition(displayLocation); //если все ок, то вызываем метод getCurrentPosition и передаем ей нашу функцию displayLocation, реализую ее ниже.
	}
	else {
		alert("Упс, геолокация не поддерживается"); //выведем сообщение для старых браузеров.
	}
}
if (!flag)
{
    function  displayLocation(position) 
    {
        flag = true;
        //передаем в нашу функцию объект position - этот объект содержит ширину и долготу и еще массу всяких вещей.
        latitude = position.coords.latitude; // излвекаем широту
        longitude = position.coords.longitude; // извлекаем долготу
        //Теперь пришло время все это записать в наш  DOM
        let deleteElement = document.getElementById('map');
        deleteElement.innerHTML = '';
        ymaps.ready(init);
            function init(){
                if(myMap){
                    myMap.destroy();
                    myMap = null;
                myMap = new ymaps.Map("map", {
                    center: [latitude, longitude],
                    zoom: 15,
                    controls: []
                });
                let placemark = new ymaps.Placemark([latitude,longitude ], {});
                myMap.geoObjects.add(placemark);
                //определение города
                if(window.matchMedia("only screen and (max-width: 760px)").matches) 
                {
                    ymaps.geolocation.get({
                        // Зададим способ определения геолокации
                        // на основе ip пользователя.
                        provider: 'auto',
                        // Включим автоматическое геокодирование результата.
                        autoReverseGeocode: true
                    }).then(function (result) {
                        // Выведем результат геокодирования.
                        let city = result.geoObjects.get(0).properties.get('text').substr(8, 6);
                        document.getElementById('need').innerHTML = '';
                        document.querySelector('.city').textContent = city;
                    });
                    
                } 
                else 
                {
                    ymaps.geolocation.get({
                        // Зададим способ определения геолокации
                        // на основе ip пользователя.
                        provider: 'yandex',
                        // Включим автоматическое геокодирование результата.
                        autoReverseGeocode: true
                    }).then(function (result) {
                        // Выведем результат геокодирования.
                        let city = result.geoObjects.get(0).properties.get('text').substr(8);
                        document.getElementById('need').innerHTML = '';
                        document.querySelector('.city').textContent = city;
                    }); 
                }

            }

            if (flag)
            {
                let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
                fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${latitude}&lon=${longitude}&exclude=alerts&appid=${apiKey}&lang=ru`)
                .then(function(resp){return resp.json() })
                .then(function(data)
                {   
                    console.log(data)
                    // погода для основого баннера
                    document.getElementById('need').innerHTML = '';
                    document.querySelector('.temp').textContent = Math.round(data.current.temp-273);
                    document.querySelector('.feels').textContent = Math.round(data.current.feels_like-273);
                    document.querySelector('.humidity').textContent = data.current.humidity;
                    document.querySelector('.wind').textContent = + data.current.wind_speed;
                    document.querySelector('.desctription').textContent = data.current.weather[0].description;
                    document.querySelector('.feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;    //хитрый трюк для получения иконки
            
                    if (data.current.weather[0].main == 'Snow')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/day_cloudy.jpg')";
                        document.getElementById('weather').style.backgroundImage = "url('./img/snow4.png')";
                        document.getElementById('weather').style.animationDuration = "1s";
                    }
                    if (data.current.weather[0].main == 'Clouds')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/day_cloudy.jpg')";
                        document.getElementById('weather').style.backgroundImage = "url()";
                    }
                    if (data.current.weather[0].main == 'Rain')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/day_cloudy.jpg')";
                        document.getElementById('weather').style.backgroundImage = "url('./img/rain6.png')";
                        document.getElementById('weather').style.animationDuration = "0.3s";
                    }
                    if (data.current.weather[0].main == 'Drizzle')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/day_cloudy.jpg')";
                        document.getElementById('weather').style.backgroundImage = "url('./img/rain6.png')";
                        document.getElementById('weather').style.animationDuration = "0.3s";
                    }
                    if (data.current.weather[0].main == 'Clear' && data.current.weather[0].description == 'ясно')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/clear_day.jpeg')";
                        document.getElementById('weather').style.backgroundImage = "url()";
                    }
                    if (data.current.weather[0].main == 'Clear' && data.current.weather[0].description == 'ясно' && data.current.weather[0].icon == '01n')
                    {
                        document.getElementById('tab').style.backgroundImage = "url('./img/night_clear.jpeg')";
                        document.getElementById('weather').style.backgroundImage = "url()";
                    }
                    if (data.current.weather[0].icon == '01n')
                    {
                        document.querySelector('.feature').innerHTML = `<img src = "./img/moon_test.png">`;
                    }
                    if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
                    {
                        document.querySelector('.feature').innerHTML = `<img src = "./img/snowflake.png">`;
                    }
            
                    //sunrise sunset
            
                    let sunriseDate = moment.unix(data.current.sunrise).format("HH:mm");
                    let sunsetDate = moment.unix(data.current.sunset).format("HH:mm");
                    
                    document.querySelector('.sunrise-time-info').textContent = sunriseDate;
                    document.querySelector('.sunset-time-info').textContent = sunsetDate;
                    
                    //schedule info header
            
                    moment.locale('ru');
                    moment.tz(data.timezone);
                    let unix_time = data.current.dt;
                    let time = moment(unix_time*1000).tz(data.timezone);
            
                    document.querySelector('.schedule-header').textContent = time.format('dddd');
                    document.querySelector('.schedule-date').textContent = time.format('MMMM , DD');
            
                    //day length
            
                    let unixDayLength = data.current.sunset - data.current.sunrise;
                    DayLengthObj = new Date(unixDayLength*1000);
                    let utcString  = DayLengthObj.toGMTString();
                    let timeHR = utcString.slice(-11, -10);
                    let timeMIN = utcString.slice(-9, -7);
            
                    document.querySelector('.day-length-info').textContent = timeHR + " ч " + timeMIN + "  мин";
            
                    //uv index
            
                    document.querySelector('.uf-index-info').textContent = data.current.uvi;
            
                    //pressure
            
                    document.querySelector('.pressure-info').textContent = Math.round((data.current.pressure)/1.3) + " мм рт.ст."; 
                    
                    //for night 
            
                    document.querySelector('.night-temp').textContent = Math.round(data.daily[0].temp.night-273) + ' °C';
                    document.querySelector('.night-feel').textContent = Math.round(data.daily[0].feels_like.night-273) + ' °C';
            
                    //for morning
                    document.querySelector('.morning-temp').textContent = Math.round(data.daily[0].temp.morn-273) + ' °C';
                    document.querySelector('.morning-feel').textContent = Math.round(data.daily[0].feels_like.night-273) + ' °C';
                
                    //for day
                    document.querySelector('.day-temp').textContent = Math.round(data.daily[0].temp.day-273) + ' °C';
                    document.querySelector('.day-feel').textContent = Math.round(data.daily[0].feels_like.day-273) + ' °C';
            
                    //for even
                    document.querySelector('.evening-temp').textContent = Math.round(data.daily[0].temp.eve-273) + ' °C';
                    document.querySelector('.evening-feel').textContent = Math.round(data.daily[0].feels_like.eve-273) + ' °C';
                    
                    //schedule info elements info
                    let date;
                    let temp;
                    let vis;
                    for (let i = 0; i < 25; i++)
                    {
                        date = moment.unix(data.hourly[i].dt).format("HH:mm");
                        document.getElementById(`elem-time${i}`).textContent = date;
                        temp = data.hourly[i].temp
                        document.getElementById(`elem-temp${i}`).textContent = Math.round(temp-273) + ' °C';
                        document.getElementById(`elem-feature${i}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                        document.getElementById(`elem-desc${i}`).textContent = data.hourly[i].weather[0].description;
                        document.getElementById(`elem-pop${i}`).textContent = "Вероятность осадков " + Math.round(data.hourly[i].pop)*10 + '%';
                        vis = data.hourly[i].visibility;
                        if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                        {
                            document.getElementById(`elem-feature${i}`).innerHTML = `<img src = "./img/snowflake.png">`;
                        }
                        if (data.hourly[i].weather[0].icon == '01n' || data.hourly[i].weather[0].icon == 'c01n' )
                        {
                            document.getElementById(`elem-feature${i}`).innerHTML = `<img src = "./img/moon_test.png">`;
                        }
                        if (vis == 10000)
                        {
                            document.getElementById(`elem-vis${i}`).textContent = "Отличная видимость";
                            continue;
                        }
                        document.getElementById(`elem-vis${i}`).textContent = "Видимость " + Math.round((data.hourly[i].visibility)/1000) + ' км';
                    }
            
            
                    //seven days info left table
                    for (i = 1; i < 8; i++)
                    {
                        document.getElementById(`high-date${i}`).textContent = moment.unix(data.daily[i].dt).format('MMMM , DD');
                        document.getElementById(`seven-days-weather${i}`).textContent = data.daily[i].weather[0].description;
                        document.getElementById(`seven-days-max${i}`).textContent = Math.round(data.daily[i].temp.max-273)+ ' °C';
                        document.getElementById(`seven-days-min${i}`).textContent = Math.round(data.daily[i].temp.min-273)+' °C';
                        document.getElementById(`sd-wind-spd${i}`).textContent = Math.round(data.daily[i].wind_speed) + ' м/c';
                        document.getElementById(`sd-wind-dir${i}`).textContent = data.daily[i].wind_deg + '°';
                        document.getElementById(`sd-wind-gusts${i}`).textContent = 'до ' + Math.round(data.daily[i].wind_gust) +' м/c';
                        document.getElementById(`seven-days-hum${i}`).textContent = data.daily[i].humidity + ' %';
                        document.getElementById(`seven-days-pop${i}`).textContent = Math.round(data.daily[i].pop)*10 + ' %';
                        document.getElementById(`seven-days-vis${i}`).textContent = Math.round((data.hourly[i].visibility)/1000) + ' км';
                        document.getElementById(`seven-days-img${i}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                        if (data.hourly[i].weather[0].icon == '01n')
                        {
                            document.getElementById(`seven-days-img${i}`).innerHTML = `<img src = "./img/moon_test.png">`;
                        }
                        if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                        {
                            document.getElementById(`seven-days-img${i}`).innerHTML = `<img src = "./img/snowflake.png">`;
                        }
                        //for night 
                        document.getElementById(`night-temp${i}`).textContent = Math.round(data.daily[i].temp.night-273) + ' °C';
                        document.getElementById(`night-feel${i}`).textContent = Math.round(data.daily[i].feels_like.night-273) + ' °C';
            
                        //for morning
                        document.getElementById(`morning-temp${i}`).textContent = Math.round(data.daily[i].temp.morn-273) + ' °C';
                        document.getElementById(`morning-feel${i}`).textContent = Math.round(data.daily[i].feels_like.night-273) + ' °C';
                
                        //for day
                        document.getElementById(`day-temp${i}`).textContent = Math.round(data.daily[i].temp.day-273) + ' °C';
                        document.getElementById(`day-feel${i}`).textContent = Math.round(data.daily[i].feels_like.day-273) + ' °C';
            
                        //for even
                        document.getElementById(`evening-temp${i}`).textContent = Math.round(data.daily[i].temp.eve-273) + ' °C';
                        document.getElementById(`evening-feel${i}`).textContent = Math.round(data.daily[i].feels_like.eve-273) + ' °C';
            
                        sunriseDate = moment.unix(data.daily[i].sunrise).format("HH:mm");
                        sunsetDate = moment.unix(data.daily[i].sunset).format("HH:mm");
                    
                        document.getElementById(`seven-days-sunrise${i}`).textContent = sunriseDate;
                        document.getElementById(`seven-days-sunset${i}`).textContent = sunsetDate;
                        document.getElementById(`seven-days-uv${i}`).textContent = data.current.uvi;
            
                    }
                    let apiKey2 = `839fd17424b948c2a24a849cbde26db7`
                    let url = `https://api.weatherbit.io/v2.0/forecast/hourly?lat=${latitude}&lon=${longitude}&key=${apiKey2}&hours=193&lang=ru`
                    fetch(url)
                        .then(function(resp){return resp.json() })
                        .then(function(dataW)
                        { 
                            console.log(dataW);
                            let current = moment.unix(dataW.data[0].ts).format("DD");
                            let labels = [];
                            let dataArray = [];
                            let i1;
                            //первый график
                            for (let i = 0; i < 25; i++)
                            {
                                let everyDate = moment.unix(dataW.data[i].ts).format("DD");
                                if (everyDate == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i1 = i;
                                    break;
                                }
                            }
                            let data0 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ],
                            }
                            let canvas0 = document.getElementById("Chart0");
                            let ctx0 = canvas0.getContext("2d");
                            
                            let config0 = 
                            {
                                type: 'line',
                                data: data0,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    },
                                },
            
                            };
                            Chart0 = new Chart(ctx0, config0);
                    
                            //второй график
                            current = moment.unix(dataW.data[i1].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i2;
                            for (let i = i1; i < 49; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i2 = i;
                                    break;
                                }
                            }
                            let data1 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas1 = document.getElementById("Chart1");
                            let ctx1 = canvas1.getContext("2d");
                    
                            let config1 = 
                            {
                                type: 'line',
                                data: data1,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    },
                    
                                },
                            };
                            Chart1 = new Chart(ctx1, config1);
                    
                            //третий график
                            current = moment.unix(dataW.data[i2].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i3;
                            for (let i = i2; i < 73; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i3 = i;
                                    break;
                                }
                            }
                            let data2 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas2 = document.getElementById("Chart2");
                            let ctx2 = canvas2.getContext("2d");
                    
                            let config2 = 
                            {
                                type: 'line',
                                data: data2,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    }, 
                    
                                },
                            };
                            Chart2 = new Chart(ctx2, config2);
                    
                            //четвертый график
                            current = moment.unix(dataW.data[i3].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i4;
                            for (let i = i3; i < 97; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i4 = i;
                                    break;
                                }
                            }
                            let data3 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas3 = document.getElementById("Chart3");
                            let ctx3 = canvas3.getContext("2d");
                    
                            let config3 = 
                            {
                                type: 'line',
                                data: data3,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    },
                    
                                },
                            };
                            Chart3 = new Chart(ctx3, config3);
                            //пятый график
                            current = moment.unix(dataW.data[i4].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i5;
                            for (let i = i4; i < 121; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i5 = i;
                                    break;
                                }
                            }
                            let data4 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas4 = document.getElementById("Chart4");
                            let ctx4 = canvas4.getContext("2d");
                    
                            let config4 = 
                            {
                                type: 'line',
                                data: data4,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    }, 
                    
                                },
                            };
                            Chart4 = new Chart(ctx4, config4);
                            //шестой график
                    
                            current = moment.unix(dataW.data[i5].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i6;
                            for (let i = i5; i < 145; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                {
                                    i6 = i;
                                    break;
                                }
                            }
                            let data5 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas5 = document.getElementById("Chart5");
                            let ctx5 = canvas5.getContext("2d");
                    
                            let config5 = 
                            {
                                type: 'line',
                                data: data5,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    }, 
                    
                                },
                            };
                            Chart5 = new Chart(ctx5, config5);
                    
                            //седьмой график
                    
                            current = moment.unix(dataW.data[i6].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            let i7;
                            for (let i = i6; i < 169; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else{
                                    i7 = i;
                                    break;
                                }
                            }
                            let data6 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
            
                                    }
                                ]
                            }
                            let canvas6 = document.getElementById("Chart6");
                            let ctx6 = canvas6.getContext("2d");
                    
                            let config6 = 
                            {
                                type: 'line',
                                data: data6,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    },
                    
                                },
                            };
                            Chart6 = new Chart(ctx6, config6);
                            //восьмой график
                            current = moment.unix(dataW.data[i7].ts).format("DD");
                            labels = [];
                            dataArray = [];
                            for (let i = i7; i < 193; i++)
                            {
                                if (moment.unix(dataW.data[i].ts).format("DD") == current)
                                {
                                    labels.push(moment.unix(dataW.data[i].ts).format("HH:mm"));
                                    dataArray.push(dataW.data[i].temp);
                                }
                                else
                                    break;
                            }
                            let data7 = 
                            {
                                labels,
                                datasets: [
                                    {
                                        data: dataArray,
                                        label: "Фактическая температура",
                                        borderColor: "white",
                                        borderWidth: "2",
                                        tension: 0.5,
                                        pointHitRadius: 15,
                                        pointBorderColor: 'transparent',
                                        pointBackgroundColor: 'transparent',
                                        pointHoverBackgroundColor: 'white',
                                        fill: true,
                                        backgroundColor: [
                                            'rgba(255,255,255,0.5'
                                        ]
                                    }
                                ]
                            }
                            let canvas7 = document.getElementById("Chart7");
                            let ctx7 = canvas7.getContext("2d");
                    
                            let config7  = 
                            {
                                type: 'line',
                                data: data7,
                                options: 
                                {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins:{
                                        legend:{
                                            display: false,
                                            labels:{
                                                display: false,
                                            }
                                        }
                                    },  
                                },
                            };
                            Chart7 = new Chart(ctx7, config7);
                        })
                })
            }
        }
    
    
    }
    
    
}

function Update()
{
    Chart0.destroy();
    Chart1.destroy();
    Chart2.destroy();
    Chart3.destroy();
    Chart4.destroy();
    Chart5.destroy();
    Chart6.destroy();
    Chart7.destroy();
    return false;
}
