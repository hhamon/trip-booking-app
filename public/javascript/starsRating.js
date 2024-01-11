function registerRatingEvents()
{
    let list = ["star1","star2","star3","star4","star5"]
    list.forEach(function(element) {
        document.getElementById(element).addEventListener("click", function() {
            let elemObj = document.getElementById(element);
            let starNum = elemObj.dataset["starnum"];
            $('#rate_offer_rating').val(parseInt(starNum));
            for(let i=1; i<=parseInt(starNum); ++i)
            {
                let currentStar = document.getElementById(list[i-1]);
                let classes = currentStar.className;
                if(classes.includes('far')) {
                    currentStar.classList.remove("far");
                    currentStar.classList.add("fas")
                }
            }
            for(let i = parseInt(starNum) + 1; i<=5; i++)
            {
                let currentStar = document.getElementById(list[i-1]);
                let classes = currentStar.className;
                if(classes.includes('fas')) {
                    currentStar.classList.remove("fas");
                    currentStar.classList.add("far")
                }
            }
        })
    });
}