let clock1 = document.querySelector('.currTime');
let clock2 = document.querySelector('.gmtTime');

function time()
{
    let date = new Date();
    let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
    let min = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    let sec = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

    let date2 = new Date();

    // let hours2 = date2.getHours() < 10 ? '0' + date2.getHours() : date2.getHours();
    let min2 = date2.getMinutes() < 10 ? '0' + date2.getMinutes() : date2.getMinutes();
    let sec2 = date2.getSeconds() < 10 ? '0' + date2.getSeconds() : date2.getSeconds();
    hours2 = moment().utc().format('HH'); 
    clock1.innerHTML = `${hours}:${min}:${sec}`;
    clock2.innerHTML = `${hours2}:${min2}:${sec2}`;
}
setInterval(time, 1000);