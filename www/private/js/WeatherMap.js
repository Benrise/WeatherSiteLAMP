
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
options = {
    key: 'TBH7yYIILCw1h4FBTp3f1kidVSlKvzLf', 
    verbose: false,

    lat: 55.75,
    lon: 37.64,
    zoom: 3,
};
windyInit(options, windyAPI => {
    const { map } = windyAPI;
});

function  displayLocation(position) 
    {
        //передаем в нашу функцию объект position - этот объект содержит ширину и долготу и еще массу всяких вещей.
        lat = position.coords.latitude; // излвекаем широту
        lon = position.coords.longitude; // извлекаем долготу
        options = {
            key: 'TBH7yYIILCw1h4FBTp3f1kidVSlKvzLf', 
            verbose: false,
        
            lat: 55.75,
            lon: 37.64,
            zoom: 10,
        };
        windyInit(options, windyAPI => {
            const { map } = windyAPI;
            L.map().setLatLng([lat, lon])
        });
        let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
                fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=alerts&appid=${apiKey}&lang=ru`)
                .then(function(resp){return resp.json() })
                .then(function(data){
                    console.log(data);
                    let date;
                    let temp;
                    document.querySelector('.feature-right').style.width = '190px';
                    for (let i = 0; i < 25; i++)
                    {
                        date = moment.unix(data.hourly[i].dt).format("HH:mm");
                        document.getElementById(`elem-time${i}`).textContent = date;
                        temp = data.hourly[i].temp
                        document.getElementById(`elem-temp${i}`).textContent = Math.round(temp-273) + ' °C';
                        document.getElementById(`elem-featureMap${i}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                        if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                        {
                            document.getElementById(`elem-featureMap${i}`).innerHTML = `<img src = "./img/snowflake.png">`;
                        }
                        if (data.hourly[i].weather[0].icon == '01n')
                        {
                            document.getElementById(`elem-featureMap${i}`).innerHTML = `<img src = "./img/moon_test.png">`;
                        }
                    }
                    //определение города
                    ymaps.geolocation.get({
                        // Зададим способ определения геолокации
                        // на основе ip пользователя.
                        provider: 'yandex',
                        // Включим автоматическое геокодирование результата.
                        autoReverseGeocode: true
                    }).then(function (result) {
                        // Выведем результат геокодирования.
                        let city = result.geoObjects.get(0).properties.get('text').substr(8);
                        document.querySelector('.city').textContent = city;
                    });
                    document.querySelector('.temp').textContent = Math.round(data.current.temp-273) + ' °C';
                    document.querySelector('.description').textContent = data.current.weather[0].description;
                    moment.locale('ru');
                    let dayOfWeek = moment.unix(data.current.dt).format('dddd');
                    let monthYear = moment.unix(data.current.dt).format('MMMM , yy ');
                    document.querySelector('.feature-right').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;
                    if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
                    {
                        document.querySelector('.feature-right').innerHTML = `<img src = "./img/snowflake.png">`;
                    }
                    if (data.current.weather[0].icon == '01n')
                    {
                        document.querySelector('.feature-right').innerHTML = `<img src = "./img/moon_test.png">`;
                    }
                    document.querySelector('.day-of-week').textContent = dayOfWeek;
                    document.querySelector('.month').textContent = monthYear;
                    
                })
    }
function updateLocation()
{
    window.onload = getMyLocation;
    getMyLocation();
    displayLocation();
    return false;
}



