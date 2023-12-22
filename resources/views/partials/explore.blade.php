<style>
/* Apply a box-sizing reset to ensure padding and borders are included in the element's total width and height */
* {
  box-sizing: border-box;
}

/* Set a minimum height for the section to ensure content fits within the viewport */
.explore {
  height: auto;
}

/* Style the max-width container for responsiveness */
.max-width {
  max-width: auto; /* Adjust as needed */
  margin: 0 auto; /* Center the container */
}

/* Use flexbox for the parent container to distribute items evenly */
.parent {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

/* Style the individual pic elements */
.pic {
  text-align: center; /* Center the content within each pic */
  margin: 10px; /* Adjust spacing between pics */
}

/* Use media queries for responsive adjustments */
@media (max-width: 768px) {
  .parent {
    justify-content: center; /* Center items when screen size is smaller */
  }
}

/* Add similar styles for the text section */
.text-explore {
  height: auto;
}

.parent-text {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}

.text-pic {
  text-align: center;
  margin: 10px;
}

/* Additional media queries for responsive adjustments if needed */



</style>


<section class="explore border-bottom mt-0" id="explore">
  <div class="max-width">
    <div class="explore-content">
      <div class="text-1">
        <p class= "p-3"  style ="font-weight: bold"> EXPLORE </p>
      </div>
      <div class="parent" style="display: flex; align-items:center;margin-left:17px;justify-items:center;">
        <div class="pic" id="icons">
          <a href="/freeproducts">
          <img src="/images/shop.jpg" alt="free" style="width:80px; height:80px; ">
          </a>
          <div class="text-pic" id="text-pic">
          <p style ="font-weight: bold;"> FREE</p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/electronicproducts">
          <img src="/images/laptop.jpg" alt="electronicproducts" style="width:80px; height:80px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold;" > ELECTRONICS </p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/bookproducts">
          <img src="/images/book.jpg" alt="books"  style="width:80px; height:90px;" >
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold;"> BOOKS </p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/femalefashion">
          <img src="/images/dress.jpg" alt="women" style="width:80px; height:80px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold ;"> WOMEN'S  </p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/malefashion">
          <img src="/images/men.jpg" alt="men" style="width:80px; height:80px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold; ;"> MEN'S  </p>
          </div>
        </div>
        <div class="pic" id="icons" >
          <a href="/cosmeticproducts">
          <img src="/images/cosmetics.jpg" alt="cosmetics" style="width:120px; height:80px; margin-right: 0px;">
          </a>
          <div class="pic" class="text-pic" id="text-pic" >
            <p style ="font-weight: bold; "> COSMETICS </p>
          </div>
        </div>
        <div   class="pic" id="icons">
          <a href="/shoes">
          <img src="/images/shoes.jpg" alt="shoes" style="width:80px; height:80px; margin-right: 0px; margin-left: 0px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold;bold; ;"> SHOES </p>
          </div>
        </div>
        <div  class="pic" id="icons">
          <a href="/mahallah">
          <img src="/images/equipment.png" alt="mahallah" style="width:80px; height:80px;  margin-right: 10px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold;"> HOUSEHOLD </p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/otherproducts">
          <img src="/images/others.png" alt="search" style="width:75px; height:75px;">
          </a>
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold; "> OTHERS </p>
          </div>
        </div>
        <div class="pic" id="icons">
          <a href="/discussion">
            <img src="/images/community.png" alt="discussion" style="width:80px; height:80px; margin-right: 25px;">
          </a> 
          <div class="text-pic" id="text-pic">
            <p style ="font-weight: bold; "> COMMUNITY FORUM </p>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>