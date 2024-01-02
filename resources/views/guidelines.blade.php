<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/sell.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
</head>
<body >
    
    @include('partials.header')

    <div class="container mt-2" style="min-height: 70vh;">
   
    <h4 style="text-align: center;margin-top:30px;margin-bottom:30px;">WELCOME TO  IIUM SECOND-HAND ONLINE SHOP</h4>
 
     <p>The mission of this platform is to serve as a means for all IIUM students, particularly those in the Gombak branch, to efficiently distribute their second-hand items.</p>
     <p>With the utilization of this website, we aim to facilitate students in promoting their second-hand items and expanding their reach to a broader audience of potential buyers.</p>
     
     <h4>User Registration</h4>
     <p>Users are required to register on the platform before listing or purchasing items.</p>
     <p> It is strongly recommended to complete detailed profiles to provide comprehensive information to potential buyers.
     Additionally, registering bank account details is highly suggested to broaden the range of payment methods available to buyers.</p>
     <p>You can register you bank account <a href="/payment" style="color: black;"> here </a>  or select the "Add Bank Account Details" in the settings profile section</p>
     <p>We assure users that their bank account information is secure and will only be used for transaction processes.</p>
     
     <h4>Product Listing</h4>
     <p>List your second-hand items for sale by clicking the designated button or you can <a href="/sell" style="color: black;"> click here </a>, which will direct you to the listing page.</p>
     <img src="/images/listing.png" alt="discussion" style=" margin-right: 25px;" class="mt-2 mb-2">

     
     <ul>
         <li>Include images and detailed information about the product.</li>
         <li>Upload high-quality images from various angles to effectively showcase the product.</li>
         <li>Refer to provided guidelines <a href="/cond_details" style="color: black;"> here </a>  when determining the condition of your product.</li>
         <li>Compulsory provision of a meetup point for self-pickup by the buyer.</li>
         <li>A more detailed product description increases the likelihood of attracting potential buyers.</li>
     </ul>
     
     <h4>Transaction Process</h4>
     <ul>
         <li>Payment methods include online bank transfer or cash.</li>
         <li>Buyers must upload payment receipts for online transfers before product delivery.</li>
         <li>Cash transactions occur during the buyer and seller meet-up for delivery.</li>
     </ul>
     
     <p style="font-weight: bold;">It is important to note:</p>
     <ol>
         <li>We declare no responsibility for transactions between sellers and buyers, including any incidents or issues that may arise during or after a transaction.</li>
         <li>This website serves solely as a facilitator, providing a platform for sellers and buyers to engage in transactions.</li>
         <li>In the event of disputes, buyers are encouraged to engage in open communication with the seller directly.</li>
     </ol>
     
     <ul>
         <li>Sellers can update the order progress in the system to inform buyers about the status of their order.</li>
         <li>The completion status of the order depends on the buyer, who must update upon receiving their order.</li>
     </ul>
     
     <h4>User Reviews and Ratings</h4>
     <p>After receiving a product, users can provide reviews and ratings for the order.</p>
     
     <h4>Community Forum</h4>
     <ul>
         <li>We provide a community forum for users to engage in discussions related to our system. <a href="/discussion" style="color: black;">Click here to join or create discussion</a></li>
         <img src="/images/communityforum.png" alt="discussion" style=" margin-right: 25px;" class="mt-3">

         <li>Users are encouraged to offer suggestions for system improvements in this forum.</li>
         <li>If you prefer a direct approach, you can contact the administrator for assistance. Use the "Contact Admin" feature or <a href="/contactadmin" style="color: black;">click here</a></li>
         <img src="/images/chatadmin.png" alt="discussion" style=" margin-right: 25px;" class="mt-2 mb-2">
     </ul>

     <h4>Guidelines for Responsible Selling and Buying</h4>
     <p>While engaging in transactions on this platform, we encourage users to uphold ethical practices. Sellers should accurately represent the condition of their items, and buyers are urged to communicate openly about their expectations.</p>
     
     <p>Our community values integrity, and we expect all users to treat each other with respect and honesty throughout the buying and selling process.</p>
     
     <h4>Prohibited Items</h4>
     <p>Ensure that all listed items comply with our guidelines. The sale of prohibited items, including but not limited to illegal substances, counterfeit goods, and hazardous materials, is strictly forbidden.</p>
     
     <h4>Security Tips</h4>
     <p>Protect yourself and your transactions by being cautious. Avoid sharing sensitive information such as passwords and personal identification outside the designated transaction channels. Report any suspicious activity immediately to our support team.</p>

     <h4>Filtering Feature</h4>
    <p>Take advantage of our website's filtering feature to find products based on category preferences, price, condition, and more. Customize your search to discover the items that best match your requirements.</p>

     
     <h4>Termination of Accounts</h4>
     <p>We reserve the right to terminate accounts that violate our guidelines or engage in fraudulent activities. Users are responsible for the accuracy of their listings and adherence to the community standards.</p>
     
     <a type="button" class="btn btn-outline-secondary mb-4" href="/homepage" >Back</a>
    

    </div>

    
        


    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</body>
</html>