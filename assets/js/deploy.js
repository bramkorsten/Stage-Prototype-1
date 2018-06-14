var servers;

function refreshServers() {
  $('#server-list .server').remove();
  getServers();
}

function getServers() {
  $.getJSON( "phploy/api/get.php?t=servers", function( data ) {
    $.each(data, function(i, item) {
      console.log(data[i]);
      servers = data;
        appendServer(data[i], i);
    })
  });
}

$(function () {
  refreshServers();

  $('#new-server-form').on('submit', function (e) {
    e.preventDefault();
    $('#new-server-spinner').toggleClass('visible');

    $.ajax({
      type: 'post',
      url: 'phploy/api/post.php?t=newserver',
      data: $('#new-server-form').serialize(),
      success: function (response) {
        console.log(response);
        jsonMessage = JSON.parse(response);
        if (jsonMessage.code == 1) {
          setContentArea('#select-servers');
        } else {
          alert("please fill in all fields");
        }
        $('#new-server-spinner').toggleClass('visible');
      }
    });
  });
});

function appendServer(data, id) {
  id = "server-" + id;
  serverList = $("#server-list");
  date = Date.parse(data.updated_at).toString("d MMM yyyy");
  date1 = new Date ( date );
  $("<div>", {class: "server", id: id}).append(
        $("<svg>", {class: "spinner", id: "deploying-spinner", viewBox: "0 0 66 66"}).append(
            $("<circle>", {class: "path", fill: 'none', 'stroke-width': '6', 'stroke-linecap': 'round', cx: '33', cy: '33', r: '30'}),
        ),
        $("<i>", {class: "select selected fas fa-check-square"}),
        $("<i>", {class: "done fas fa-check"}),
        $("<div>", {class: "name"}).append(
            $("<span>", {class: "title"}).text(
                data.name
            ),
            $("<span>", {class: "url"}).text(
                data.human_url
            )
        ),
        $("<span>", {class: "core-version"}).text(
            "v" + data.master_version
        ),
        $("<span>", {class: "mod-version"}).text(
            "v" + data.modules_version
        ),
        $("<div>", {class: "branches"}).append(
            $("<span>", {class: "branch-core"}).text(
                data.master_branch
            ),
            $("<span>", {class: "branch-mod"}).text(
                data.modules_branch
            )
        ),
        $("<span>", {class: "last-deployed"}).text(
            date
        ),
        $("<i>", {class: "settings"})
    ).appendTo(serverList);
}

function deployServers() {
  var server = servers[0]; //You are in the current object
  deploy(server, 0);
}

function deploy(server, id) {
  console.log("deploying server " + id + ". " + server.name);
  fullid = "server-" + id;
  $('#' + fullid).toggleClass('deploying');

  $.ajax({
    type: 'post',
    url: 'phploy/deploy.php',
    data: {
        'host': server.ftp_url,
        'port': server.ftp_port,
        'user': server.username,
        'pass': server.password,
        'type': 'master'
    },
    success: function (response) {
      console.log(response);
      var hasError = false;
      messages = response.deployment.results.messages;
      for(var i = 0; i < messages.length; i++) {
        if (messages[i].type == 'warning' || messages[i].type == 'error') {
          hasError = true;
        }
      }
      if (hasError) {
        $('#' + fullid).toggleClass('deploying error');
      }
      else {
        $('#' + fullid).toggleClass('deploying succes');
      }
      id++;
      if (id < servers.length) {
        deploy(servers[id], id);
      } else {
        console.log("Done Deploying!");
      }

    }
  });
}

function setContentArea(area) {
  $('.content.active').toggleClass('active');
  $(area).toggleClass('active');
}
