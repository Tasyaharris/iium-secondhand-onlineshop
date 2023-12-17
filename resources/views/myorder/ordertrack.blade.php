<nav class="side-navbar1" style="margin-left:10px;padding:0px; display:inline-block;">
    <div class="order-title" style="display: inline-flex;">
    <!-- Your sidebar content goes here -->
    <div class="table-container1" style="margin-left:px;">
    <table class="selection1" >
      <tr>
        <td class="clickable-row {{ Request::is('process') ? 'active' : '' }}" data-href="/process" style="width: 145px;">
            <a class="navbar-brand" href="/process" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
                <img src="/images/process.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
                Process
            </a>
        </td>
        <td class="clickable-row {{ Request::is('deliveryorder') ? 'active' : ' ' }}" data-href="/deliveryorder" style="width: 148px; ">
          <a class="navbar-brand" href="/deliveryorder" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/delivery.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Delivery
          </a>
      </td>
      <td class="clickable-row {{ Request::is('receiveorder') ? 'active' : ' ' }}" data-href="/receiveorder" style="width: 148px; ">
          <a class="navbar-brand" href="/receiveorder" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/receive.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Receive
          </a>
      </td>
      <td class="clickable-row {{ Request::is('completedorder') ? 'active' : ' ' }}" data-href="/completedorder" style="width: 148px; ">
        <a class="navbar-brand" href="/completedorder" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
            <img src="/images/completed.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
            Completed
        </a>
    </td>
      <td class="clickable-row {{ Request::is('cancelorder') ? 'active' : ' ' }}" data-href="/cancelorder" style="width: 148px; ">
          <a class="navbar-brand" href="/cancelorder" style="display: block; text-align: center; margin: 0; padding: 0; font-size:15px;">
              <img src="/images/cancel.png" alt="logo" width="30" height="30" style="display: block; margin: 0 auto;">
              Cancelled
          </a>
      </td>
      </tr>
    </table>
    </div>  
  </div>
  </nav>