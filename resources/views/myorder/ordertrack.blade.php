<nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
    <div class="order-title" style="display: inline-flex;">
    <h5 style="margin-top:20px; text-align:center; margin-left: 45px; ">My Order</h5>
    <!-- Your sidebar content goes here -->
    <div class="table-container1" style="margin-left:52px;">
    <table class="selection1" >
      <tr>
        <td class="clickable-row {{ Request::is('delivery') ? 'active' : ' ' }}" data-href="/delivery" style="width: 139px; ">
          <a class="navbar-brand" href="/delivery" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/delivery.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Delivery
          </a>
      </td>
      <td class="clickable-row {{ Request::is('receive') ? 'active' : ' ' }}" data-href="/receiveorder" style="width: 139px; ">
          <a class="navbar-brand" href="/receive" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/receive.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Receive
          </a>
      </td>
      <td class="clickable-row {{ Request::is('completed') ? 'active' : ' ' }}" data-href="/completedorder" style="width: 139px; ">
          <a class="navbar-brand" href="/completed" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/completed.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Completed
          </a>
      </td>
      <td class="clickable-row {{ Request::is('cancelled') ? 'active' : ' ' }}" data-href="/cancelorder" style="width: 139px; ">
          <a class="navbar-brand" href="/cancelled" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/cancel.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Cancelled
          </a>
      </td>
      </tr>
    </table>
    </div>
  </div>
  </nav>