<nav class="side-navbar">
    <!-- Your sidebar content goes here -->
    <div class="table-container">
    <table class="selection">
      <tr>
        <td class="clickable-row  {{ Request::is('profile') ? 'active' : ' ' }}"  data-href="/listings">
          <a href="/profile">My Listings</a>
        </td>
        <td class="clickable-row {{ Request::is('reviews') ? 'active' : ' ' }}" data-href="/reviews">
          <a href="/reviews">Reviews</a>
        </td>
        <td class="clickable-row {{ Request::is('cart') ? 'active' : ' ' }}" data-href="/cart">
          <a href="/cart">My Cart</a>
        </td>
        <td class="clickable-row {{ Request::is('myorder') ? 'active' : ' ' }}" data-href="/myorder">
          <a href="/myorder">My Order</a>
        </td>
      </tr>
    </table>
    </div>
  </nav>