WeatherSixTeenCommon();

function WeatherSixTeenCommon()
{
    let data = "Moscow";
    let apiKey = '839fd17424b948c2a24a849cbde26db7';
    moment.locale('ru')
    document.querySelector('.head-city').textContent = 'Москва';
    let url = `https://api.weatherbit.io/v2.0/forecast/daily?city=${data}&key=${apiKey}&lang=ru`
    moment.locale('ru');
    fetch(url)
        .then(function(resp){return resp.json() })
        .then(function(data)
        {
            console.log(data); 
            for (let i = 1; i <= 15;i++)
            {
                document.getElementById(`card-dd-mm${(i)}`).textContent = moment.unix(data.data[(i)].ts).format("D MMMM");
                document.getElementById(`upper-temp${(i)}`).textContent = Math.round(data.data[i].temp) +'°C';
                document.getElementById(`upper-weather-info${(i)}`).textContent = data.data[i].weather.description;
                document.getElementById(`upper-img${(i)}`).innerHTML = `<img src="./img/weatherImg/${data.data[i].weather.icon}.png">`;
                document.getElementById(`upper-feels-info${(i)}`).textContent =  Math.round(data.data[i].temp-5)+ '°C'; 
                document.getElementById(`upper-max-info${(i)}`).textContent = data.data[i].app_max_temp + '°C';
                document.getElementById(`upper-min-info${(i)}`).textContent = data.data[i].app_min_temp + '°C';
                document.getElementById(`pop-info${(i)}`).textContent = data.data[i].pop + ' %';
                document.getElementById(`vis-infos${(i)}`).textContent = Math.round(data.data[i].vis) + ' км';
                document.getElementById(`gusks-info${(i)}`).textContent = Math.round(data.data[i].wind_gust_spd) + ' м/c';
                document.getElementById(`wind-info${(i)}`).textContent = Math.round(data.data[i].wind_spd) + ' м/с';
                document.getElementById(`wind-info-dir${(i)}`).textContent = data.data[i].wind_cdir;
                document.getElementById(`under-uv${(i)}`).textContent = data.data[i].uv;
                document.getElementById(`under-sunrise-info${(i)}`).textContent = moment.unix(data.data[i].sunrise_ts).format("HH:mm");
                document.getElementById(`under-sunset-info${(i)}`).textContent = moment.unix(data.data[i].sunset_ts).format("HH:mm");

                // document.getElementById(`alerts-info${(i)}`).textContent = 
            }    
        })
    return false;
}


function WeatherSixTeen()
{
    
    let city = document.getElementById('search').value
    let apiKey = 'a550ebb81a654a78b2c459f371115cdc';
    
    let url = `https://api.weatherbit.io/v2.0/forecast/daily?city=${city}&key=${apiKey}&lang=ru`
    moment.locale('ru');
    fetch(url)
        .then(function(resp){return resp.json() })
        .then(function(data)
        {
            document.querySelector('.head-city').textContent = city;
            console.log(data); 
            for (let i = 1; i <= 15;i++)
            {
                document.getElementById(`card-dd-mm${(i)}`).textContent = moment.unix(data.data[(i)].ts).format("D MMMM");
                document.getElementById(`upper-temp${(i)}`).textContent = Math.round(data.data[i].temp) +'°C';
                document.getElementById(`upper-weather-info${(i)}`).textContent = data.data[i].weather.description;
                document.getElementById(`upper-img${(i)}`).innerHTML = `<img src="./img/weatherImg/${data.data[i].weather.icon}.png">`;
                document.getElementById(`upper-feels-info${(i)}`).textContent =  Math.round(data.data[i].temp-5)+ '°C'; 
                document.getElementById(`upper-max-info${(i)}`).textContent = data.data[i].app_max_temp + '°C';
                document.getElementById(`upper-min-info${(i)}`).textContent = data.data[i].app_min_temp + '°C';
                document.getElementById(`pop-info${(i)}`).textContent = data.data[i].pop + ' %';
                document.getElementById(`vis-infos${(i)}`).textContent = Math.round(data.data[i].vis) + ' км';
                document.getElementById(`gusks-info${(i)}`).textContent = Math.round(data.data[i].wind_gust_spd) + ' м/c';
                document.getElementById(`wind-info${(i)}`).textContent = Math.round(data.data[i].wind_spd) + ' м/с';
                document.getElementById(`wind-info-dir${(i)}`).textContent = data.data[i].wind_cdir;
                document.getElementById(`under-uv${(i)}`).textContent = data.data[i].uv;
                document.getElementById(`under-sunrise-info${(i)}`).textContent = moment.unix(data.data[i].sunrise_ts).format("HH:mm");
                document.getElementById(`under-sunset-info${(i)}`).textContent = moment.unix(data.data[i].sunset_ts).format("HH:mm");
                // document.getElementById(`alerts-info${(i)}`).textContent = 
            }    
        })
    return false;
}
