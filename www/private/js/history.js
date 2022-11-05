

let flag = 0;
if (flag == 0)
{
    let today = new Date();
    let maxDate = moment().subtract(0, 'days').format('YYYY-MM-DD');
    let minDate = moment().subtract(4, 'days').format('YYYY-MM-DD');
    document.getElementById('dataToday').setAttribute("min", minDate);
    document.getElementById('dataToday').setAttribute("max", maxDate);
    document.getElementById('dataToday').setAttribute("value", maxDate);
    flag = 1;
}

let current_rotation = 0;
function Rotate()
{
    let city = document.querySelector('.history-search').value
    if (city == '' || city == ' ')
    {
        return false;
    }
    current_rotation -= 360;
    document.querySelector(".higher-part img").style.transform = 'rotate(' + current_rotation + 'deg)';
    return false;
}
function HistoryFunc()
{
    let city = document.querySelector('.history-search').value
    if (city == '' || city == ' ')
    {
        alert('Введите город!')
        return false;
    }
    selectedDate = document.getElementById("dataToday").value;
    selectedDateUnix = moment(selectedDate).unix();
    let apiKey = '49c8e7a1210aefbd0380c4684ee65305'
    let coordUrl = `http://api.openweathermap.org/data/2.5/weather?q=${city}&lang=ru&units=metric&appid=${apiKey}`
    fetch(coordUrl)
    .then(function(resp){return resp.json() })
    .then(function(dataСoord)
    {
        let lat = dataСoord.coord.lat;
        let lon = dataСoord.coord.lon;
        fetch(`http://api.openweathermap.org/data/2.5/onecall/timemachine?lat=${lat}&lon=${lon}&dt=${selectedDateUnix}&appid=${apiKey}&lang=ru`)
        .then(function(resp){return resp.json() })
        .then(function(data)
        {
            console.log(data);
            document.querySelector('.city-info').textContent = city;
            document.querySelector('.temp-info').textContent = 'Температура: ' + Math.round(data.current.temp-273) + ' °C';
            document.querySelector('.feel-info').textContent = 'Ощущалось как: ' + Math.round(data.current.feels_like-273) + ' °C';
            document.querySelector('.hum-info').textContent = 'Влажность: ' + data.current.humidity + ' %';
            document.querySelector('.wind-info').textContent = "Ветер: " + data.current.wind_speed + ' м/c';
            document.querySelector('.date-info').textContent = moment.unix(selectedDateUnix).format('DD.MM') + ' в ' + moment.unix(selectedDateUnix).format('HH.mm');
            document.querySelector('.desc-info').textContent = data.current.weather[0].description;
            document.querySelector('.feature-container').innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.current.weather[0]['icon']}@2x.png">`;
            if (data.current.weather[0].icon == '01n')
            {
                document.querySelector('.feature-container').innerHTML = `<img src = "./img/moon_test.png">`;
            }
            if (data.current.weather[0].icon == '13n' || data.current.weather[0].icon == '13d')
            {
                document.querySelector('.feature-container').innerHTML = `<img src = "./img/snowflake.png">`;
            }

            
            let k = 1;
            for (let i = 0; i < 24; i++)
            {
            
                if (i == 0)
                {

                    document.getElementById(`table-feature${k}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                    document.getElementById(`table-time${k}`).textContent = moment.unix(data.hourly[i].dt)/*.utc()*/.format('HH:mm');
                    document.getElementById(`table-temp${k}`).textContent = Math.round(data.hourly[i].temp-273) + ' °C';
                    document.getElementById(`table-wind${k}`).textContent = Math.round(data.hourly[i].wind_speed) + ' м/c';
                    document.getElementById(`table-press${k}`).textContent = Math.round(data.hourly[i].pressure/1.3) + ' мм рт.ст.'
                    if (data.hourly[i].weather[0].icon == '01n')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/moon_test.png">`;
                    }
                    if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/snowflake.png">`;
                    }

                    k = k+1;
                    continue;
                }
                if (i%3 == 0)
                {
                    document.getElementById(`table-feature${k}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                    document.getElementById(`table-time${k}`).textContent = moment.unix(data.hourly[i].dt)/*.utc()*/.format('HH:mm');
                    document.getElementById(`table-temp${k}`).textContent = Math.round(data.hourly[i].temp-273) + ' °C';
                    document.getElementById(`table-wind${k}`).textContent = Math.round(data.hourly[i].wind_speed) + ' м/c';
                    document.getElementById(`table-press${k}`).textContent = Math.round(data.hourly[i].pressure/1.3) + ' мм рт.ст.'
                    if (data.hourly[i].weather[0].icon == '01n')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/moon_test.png">`;
                    }
                    if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/snowflake.png">`;
                    }
                    k = k+1;
                    continue;
                }
                if (i == 23)
                {
                    document.getElementById(`table-feature${k}`).innerHTML = `<img src = "https://openweathermap.org/img/wn/${data.hourly[i].weather[0]['icon']}@2x.png">`;
                    document.getElementById(`table-time${k}`).textContent = moment.unix(data.hourly[i].dt).utc().format('HH:mm');
                    document.getElementById(`table-temp${k}`).textContent = Math.round(data.hourly[i].temp-273) + ' °C';
                    document.getElementById(`table-wind${k}`).textContent = Math.round(data.hourly[i].wind_speed) + ' м/c';
                    document.getElementById(`table-press${k}`).textContent = Math.round(data.hourly[i].pressure/1.3) + ' мм рт.ст.'
                    if (data.hourly[i].weather[0].icon == '01n')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/moon_test.png">`;
                    }
                    if (data.hourly[i].weather[0].icon == '13n' || data.hourly[i].weather[0].icon == '13d')
                    {
                        document.getElementById(`table-feature${k}`).innerHTML = `<img src = "./img/snowflake.png">`;
                    }
                    k = k + 1;
                }
            }
        })
    })
    document.querySelector('.left-container').style.top = "0px";
    document.querySelector('.right-container').style.top = "0px";
    function Visible()
    {
        document.querySelector('.under-container').style.overflow = "visible";
    }
    setTimeout(Visible, 500);





    return false;
}