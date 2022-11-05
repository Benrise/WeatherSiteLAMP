let position = 0;
let slidesToShow = 3;
let slidesToScroll = 3;

const container = document.querySelector('.daily-container');
const track = document.querySelector('.daily-track');
const btnPrev = document.querySelector('.btn-prev');
const btnNext = document.querySelector('.btn-next');

const items = document.getElementsByClassName("element")
const itemsCount = items.length;
const itemWidth = container.clientWidth / slidesToShow;
const movePosition = slidesToScroll * itemWidth;

// items.forEach((item) =>
// {
//     item.style.minWidth = `${itemWidth}px`
// });
for (let item of items)
{
    item.style.minWidth = `${itemWidth}px`
}

btnNext.addEventListener('click' , () => 
{
    const itemsLeft = itemsCount - (Math.abs(position)+slidesToShow*itemWidth)/ itemWidth;
    position -= itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

    setPosition();
    checkBtns();
});

btnPrev.addEventListener('click', () => 
{
    const itemsLeft = Math.abs(position) / itemWidth;
    position += itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

    setPosition();
    checkBtns();
});

const setPosition = () =>  
{
    track.style.transform = `translateX(${position}px)`;
};

const checkBtns = () => 
{
    btnPrev.disabled = position === 0;
    btnNext.disabled = position <= -(itemsCount - slidesToShow) * itemWidth;
};

checkBtns();    