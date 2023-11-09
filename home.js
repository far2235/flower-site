 function getMonth(){
    var date = new Date();
    var currentMonth = date.getMonth;
    const monthNames = ["January","February","March","April","May","June",
    "July","August","September","October","November","December"];
    var currentMonthName = monthNames[currentMonth];

    document.getElementsByClassName("monthFlower")[0].innerHTML = currentMonthName;

    var flowerOfTheMonth = document.createElement('div');
    flowerOfTheMonth.classList.add('month-flower');
   
    var monthText = 
    `
    <div>
      Flower of the month of November: chrysanthemum!
    </div>
    `;

    flowerOfTheMonth.innerHTML = monthText;
 }