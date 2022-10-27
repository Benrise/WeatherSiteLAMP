function Search()
{
    let data = document.getElementById('search').value;
    let failText = ""
    if (data == "" || data == " ")
        failText = "Введите город"
    if (failText != "")
        alert(failText)
    document.querySelector('.city').textContent = data;
    
    let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
    let url = `http://api.openweathermap.org/data/2.5/weather?q=${data}&lang=ru&units=metric&appid=${apiKey}`
    fetch(url)
    .then(function(resp){return resp.json() })
    .then(function(data)
    {
        console.log(data);
        let lat = data.coord.lat;
        let lon = data.coord.lon;
        W.map.panTo([lat,lon]);
        W.map.zoomIn(7);


        fetch(`https://api.openweathermap.org/data/2.5/onecall?lat=${lat}&lon=${lon}&exclude=alerts&appid=${apiKey}&lang=ru`)
        .then(function(resp){return resp.json() })
        .then(function(data){
            console.log(data);
            let date;
            let temp;
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
    })










    return false;
}