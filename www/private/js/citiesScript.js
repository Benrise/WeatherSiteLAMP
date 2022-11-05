
let mosLat = 55.75;
let mosLon = 37.64;

let yorkLat = 40.71;
let yorkLon = -74.01;

let berLat =  52.52;
let berLon = 13.41;
let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
//for moscow
fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${mosLat}&lon=${mosLon}&exclude=alerts&appid=${apiKey}&lang=ru`)
    .then(function(resp){return resp.json() })
    .then(function(data)
    {
        console.log(data);
        document.getElementById('rus-temp').textContent = Math.round(data.current.temp-273)+ ' °C';
        document.getElementById('rus-feel').textContent = Math.round(data.current.feels_like-273) + ' °C'; 
        document.getElementById('rus-hum').textContent = data.current.humidity + ' %';
        document.getElementById('rus-wind').textContent = Math.round(data.current.wind_speed) + ' м/c';
        document.getElementById('rus-desc').textContent = data.current.weather[0].description;
        document.getElementById('rus-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;
        if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
        {
            document.getElementById('rus-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.current.weather[0].icon == '01n')
        {
            document.getElementById('rus-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }

    })
//york
fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${yorkLat}&lon=${yorkLon}&exclude=alerts&appid=${apiKey}&lang=ru`)
.then(function(resp){return resp.json() })
.then(function(data)
    {
        console.log(data);
        document.getElementById('usa-temp').textContent = Math.round(data.current.temp-273)+ ' °C';
        document.getElementById('usa-feel').textContent = Math.round(data.current.feels_like-273) + ' °C'; 
        document.getElementById('usa-hum').textContent = data.current.humidity + ' %';
        document.getElementById('usa-wind').textContent = Math.round(data.current.wind_speed) + ' м/c';
        document.getElementById('usa-desc').textContent = data.current.weather[0].description;
        document.getElementById('usa-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;
        if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
        {
            document.getElementById('usa-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.current.weather[0].icon == '01n')
        {
            document.getElementById('usa-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }
    })
//berlin
fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${berLat}&lon=${berLon}&exclude=alerts&appid=${apiKey}&lang=ru`)
.then(function(resp){return resp.json() })
.then(function(data)
    {
        console.log(data);
        document.getElementById('ger-temp').textContent = Math.round(data.current.temp-273)+ ' °C';
        document.getElementById('ger-feel').textContent = Math.round(data.current.feels_like-273) + ' °C'; 
        document.getElementById('ger-hum').textContent = data.current.humidity + ' %';
        document.getElementById('ger-wind').textContent = Math.round(data.current.wind_speed) + ' м/c';
        document.getElementById('ger-desc').textContent = data.current.weather[0].description;
        document.getElementById('ger-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;
        if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
        {
            document.getElementById('ger-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.current.weather[0].icon == '01n')
        {
            document.getElementById('ger-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }
    })
function WeatherCity(x)
{
    let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
    let city = x;
    
    fetch(`http://api.openweathermap.org/data/2.5/weather?q=${city}&lang=ru&units=metric&appid=${apiKey}`)
    .then(function(resp){return resp.json()})
    .then(function(data)
    {
        console.log(data);
        document.getElementById('rus-city').textContent = data.name;
        document.getElementById('rus-temp').textContent = Math.round(data.main.temp)+ ' °C';
        document.getElementById('rus-feel').textContent = Math.round(data.main.feels_like) + ' °C'; 
        document.getElementById('rus-hum').textContent = data.main.humidity + ' %';
        document.getElementById('rus-wind').textContent = Math.round(data.wind.speed) + ' м/c';
        document.getElementById('rus-desc').textContent = data.weather[0].description;
        document.getElementById('rus-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.weather[0]['icon']}@2x.png">`;
        if (data.weather[0].icon == '13n' || data.weather[0].icon == '13d')
        {
            document.getElementById('rus-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.weather[0].icon == '01n')
        {
            document.getElementById('rus-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }

    })
    return false;
}
function WeatherCityUSA(x)
{
    let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
    let city = x;
    
    fetch(`http://api.openweathermap.org/data/2.5/weather?q=${city}&lang=ru&units=metric&appid=${apiKey}`)
    .then(function(resp){return resp.json()})
    .then(function(data)
    {
        console.log(data);
        document.getElementById('usa-city').textContent = data.name;
        document.getElementById('usa-temp').textContent = Math.round(data.main.temp)+ ' °C';
        document.getElementById('usa-feel').textContent = Math.round(data.main.feels_like) + ' °C'; 
        document.getElementById('usa-hum').textContent = data.main.humidity + ' %';
        document.getElementById('usa-wind').textContent = Math.round(data.wind.speed) + ' м/c';
        document.getElementById('usa-desc').textContent = data.weather[0].description;
        document.getElementById('usa-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.weather[0]['icon']}@2x.png">`;
        if (data.weather[0].icon == '13n' || data.weather[0].icon == '13d')
        {
            document.getElementById('usa-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.weather[0].icon == '01n')
        {
            document.getElementById('usa-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }
    })
    return false;

}
function WeatherCityGER(x)
{
    let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
    let city = x;
    
    fetch(`http://api.openweathermap.org/data/2.5/weather?q=${city}&lang=ru&units=metric&appid=${apiKey}`)
    .then(function(resp){return resp.json()})
    .then(function(data)
    {
        console.log(data);
        document.getElementById('ger-city').textContent = data.name;
        document.getElementById('ger-temp').textContent = Math.round(data.main.temp)+ ' °C';
        document.getElementById('ger-feel').textContent = Math.round(data.main.feels_like) + ' °C'; 
        document.getElementById('ger-hum').textContent = data.main.humidity + ' %';
        document.getElementById('ger-wind').textContent = Math.round(data.wind.speed) + ' м/c';
        document.getElementById('ger-desc').textContent = data.weather[0].description;
        document.getElementById('ger-feature').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.weather[0]['icon']}@2x.png">`;
        if (data.weather[0].icon == '13n' || data.weather[0].icon == '13d')
        {
            document.getElementById('ger-feature').innerHTML = `<img src = "./img/snowflake.png">`;
        }
        if (data.weather[0].icon == '01n')
        {
            document.getElementById('ger-feature').innerHTML = `<img src = "./img/moon_test.png">`;
        }
    })
    return false;

}
