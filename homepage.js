function get_month_flower(){
    const d = new Date();
    let m = d.getMonth();
    let insert = ``;

    switch(m){
        case 0:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for January: Carnation
            </header>
            <img src="images/carnation.jpg">
            <p>
                Valued for their vibrant colors, carnations are a native flower to the Mediterranean
                and have been cultivated for over two thousand years! Carnations are widely recognized
                for their frilly petals and intense fragrance.
            </p>
            `
            break;
        case 1:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for February: Violet
            </header>
            <img src="images/violet.jpg">
            <p>
                Violets are purple. I am fairly certain that is true.
            </p>
            `
            break;
        case 2:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for March: Daffodil
            </header>
            <img src="images/daffodil.jpeg">
            <p>
                March is also the daffodil just like December, I guess. Or maybe I was wrong
                about them being the same thing. Whatever.
            </p>
            `
            break;
        case 3:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for April: Daisy
            </header>
            <img src="images/daisy.jpg">
            <p>
                Daisies are cool. They just look like regular flowers.
            </p>
            `
            break;
        case 4:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for May: Lily of the Valley
            </header>
            <img src="images/lily_of_the_valley.jpg">
            <p>
                These ones are cool I like this one a lot
            </p>
            `
            break;
        case 5:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for June: Rose
            </header>
            <img src="images/red-roses.jpg">
            <p>
                Roses have been cultivated for thousands of years for their variety of colors and
                sweet fragrance. Interestingly, rose petals are edible, and used in many fancy
                dishes to add an interesting bit of texture! To learn more about roses, click
                <a href="rose.php">here</a>.
            </p>
            `
            break;
        case 6:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for July: Larkspur
            </header>
            <img src="images/larkspur.jpg">
            <p>
                These pretty purple flowers are native to the northern regions of the world, but have also
                been found growing in the mountains of Africa. Unlike the rose, it is recommended that
                you don't consume these flowers, as they are toxic to humans and most animals!
            </p>
            `
            break;
        case 7:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for August: Poppy
            </header>
            <img src="images/poppy.jpg">
            <p>
                Nobody will ever see this description so I'll just talk about the poptarts I'm eating
                right now. They're strawberry flavored and kind of warm but getting cold because it's
                cold in my room also I don't really like this poptart flavor and come to think of it
                the only poptart flavor I really do like is the hot fudge sundae ones but I only eat
                those once every few years because I don't like spending money and only eat them if
                someone else gives them to me
            </p>
            `
            break;
        case 8:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for September: Aster
            </header>
            <img src="images/aster.jpeg">
            <p>
                Asters stand tall at this time of year, just as fall sets in. This stately purple flower
                is perfect for attracting late-season pollinators to your garden! To learn more about
                asters, click <a href="aster.php">here</a>.
            </p>
            `
            break;
        case 9:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                Flower of the month for October: Marigold
            </header>
            <img src="images/marigold.jpg">
            <p>
                My mom really likes these. When I was a little kid I thought she was talking about
                a carousel or something because marigold kind of sounds like merry-go-round. They also
                reminded me of Shrek for some reason, which I cannot explain.
            </p>
            `
            break;
        case 10:
            document.getElementById("month-flower").innerHTML =`
            <header class="month-flower">
                    Flower of the month for November: Chrysanthemum
                </header>
                <img src="images/chrysanthemum.jpg">
                <p>
                    November is here and chrysanthemums are still blooming unitl winter comes!
                    A perfect flower for the fall season, mums go great alongside your fall
                    porch displays. Learn more about chrysanthemums by visiting
                    <a href="chrysanthemum.php">this page</a>.
                </p>
            `
            break;
        case 11:
            document.getElementById("month-flower").innerHTML = `
            <header class="month-flower">
                    Flower of the month for December: Narcissus
                </header>
                <img src="images/daffodil.jpeg">
                <p>
                    December's birth month flower is Narcissus, otherwise known as daffodil.
                    Interestingly, you won't be seeing any of these at this time of year- they
                    prefer to bloom in the early spring instead. To learn more, click
                    <a href="daffodil.php">here</a>.
                </p>
            `

            break;
    }


}

get_month_flower();