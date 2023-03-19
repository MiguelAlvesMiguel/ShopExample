function escreveMensagem(){
    let pai = document.getElementById('chat');
    console.log(2);
    pai.innerHTML += '<li class="clearfix"> \
                        <div class="message-data text-right"> \
                            <span class="message-data-time">10:10 AM, Today</span> \
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> \
                        </div> \
                        <div class="message other-message float-right">'+document.getElementById('texto').value+'</div> \
                    </li> '
    document.getElementById('texto').value = '';
}
document.getElementById('texto').addEventListener("keypress", function(event) { if (event.keyCode === 13) {escreveMensagem();}});
