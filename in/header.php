<header class = "header">
    <h2 class = "u-name">User <b>Tasks</b>
        <label for="checkbox">
            <i id="navbtn" class="fa-solid fa-bars"></i>
        </label>
    </h2>
    
    <span class="notification" id="notificationBtn">
        <i class="fa-solid fa-bell" aria-hidden="true"></i>
        <span id="notificationNum"></span>
    </span>
</header>
<div class="notification-bar" id="notificationBar">
    <ul id="notifications">
        
        
    </ul>
</div>



<script type="text/javascript">
    var openNotification = false;

    const notification = ()=> {
        let notificationBar = document.querySelector("#notificationBar");
        if (openNotification) {
            notificationBar.classList.remove('open-notification');
            openNotification = false;
        }else{
            notificationBar.classList.add('open-notification');
            openNotification = true;
        }
    }
        // Handle click on the notification icon
    let notificationBtn = document.querySelector("#notificationBtn");
    notificationBtn.addEventListener("click", (event) => {
        event.stopPropagation(); // Prevent event bubbling
        notification();
    });

    // Close the notification bar when clicking outside
    document.addEventListener("click", (event) => {
        let notificationBar = document.querySelector("#notificationBar");
        if (
            openNotification &&
            !notificationBar.contains(event.target) &&
            !notificationBtn.contains(event.target)
        ) {
            notificationBar.classList.remove('open-notification');
            openNotification = false;
        }
    });

    // Keep the notification count updated
    $(document).ready(function () {
        $("#notificationNum").load("app/notification_count.php");
        $("#notifications").load("app/notification.php");
    });
    
</script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $("#notificationNum").load("app/notification_count.php");
        $("#notifications").load("app/notification.php");

}); 
</script>    