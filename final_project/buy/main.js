let searchBtn = document.querySelector('#searchbtn');
let searchInput = document.querySelector('#searchinput');
let form = document.querySelectorAll('form');
let carsArr = document.querySelectorAll('.cararr')
console.log(searchInput)

ListenerStartAll();

function ListenerStartAll() {


    searchInput.addEventListener("keyup", SearchBtnPressed);

}

function SearchBtnPressed() {
    for (let i = 0; i < carsArr.length; i++) {

        if (carsArr[i].childNodes[3].childNodes[1].textContent.toLowerCase().includes(searchInput.value.toLowerCase())) {
            carsArr[i].style.display = 'block';

        } else {
            carsArr[i].style.display = 'none';
        }
    }
}