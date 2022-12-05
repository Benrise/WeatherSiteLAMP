
let latitude = 55.75
let longitude = 37.64
var flag = false;
if (!flag)
{
    flag = true;
    ymaps.ready(init);
        function init()
        {
                myMap = new ymaps.Map("map", {
                    center: [latitude, longitude],
                    zoom: 4,
                    controls: []
                });  
        }

        function changeLocation()
        {
            let apiKey = "49c8e7a1210aefbd0380c4684ee65305"
            if (getCookie('customCity') != "" && getCookie('customCity') != undefined){
                var data = getCookie('customCity');
                data = data.toString();
            }
            else{
                var data = document.getElementById('search').value
            }
            let url = `http://api.openweathermap.org/data/2.5/weather?q=${data}&lang=ru&units=metric&appid=${apiKey}`
            fetch(url)
            .then(function(resp){return resp.json() })
            .then(function(data)
                {
                    let latitude = data.coord.lat;
                    let longitude = data.coord.lon;
                    let deleteElement = document.getElementById('map');
                    deleteElement.innerHTML = '';
                    ymaps.ready(init);
                    function init()
                        {
                            if(myMap){
                                myMap.destroy();
                                myMap = null;
                            }
                            myMap = new ymaps.Map("map", {
                            center: [latitude, longitude],
                            zoom: 12,
                            controls: []
                        });
                        }


                })
                return false;
            }   
} 
    