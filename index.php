<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deploy CMS</title>
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css?v=2">
  </head>
  <body>
    <div class="deployer-wrap">
      <div class="content-wrap">
        <div class="top-bar">
          <div class="icon"></div>
          <div class="title-wrap">
            <span>Select servers</span>
            <i class="arrow fas fa-chevron-right"></i>
            <span>Review settings</span>
          </div>
        </div>
        <div id="select-servers" class="content select-servers active">
          <h2 class="content-title">Select servers to<br>deploy to</h2>
          <a href="#" onclick="setContentArea('#new-server')" class="new-server-link">Or add a new server</a>
          <div class="legend">
            <span class="select">select</span>
            <span class="name">server name</span>
            <span class="core">core version</span>
            <span class="mod">mod version</span>
            <span class="branch">branches</span>
            <span class="last">last deployed</span>
            <span class="settings"></span>
          </div>
          <div id="server-list" class="server-list-wrap">
            <div class="server deploying">
              <svg id="deploying-spinner" class="spinner" viewBox="0 0 66 66">
                 <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
              </svg>
              <i class="select selected fas fa-check-square"></i>
              <i class="done fas fa-check"></i>
              <div class="name">
                <span class="title">Villa Venray</span>
                <span class="url">https://villavenray.com</span>
              </div>
              <span class="core-version">v1.1.0</span>
              <span class="mod-version">v1.2.1</span>
              <div class="branches">
                <span class="branch-core">master</span>
                <span class="branch-mod">m-villa</span>
              </div>
              <span class="last-deployed">29 Feb 2018</span>
              <i class="settings"></i>
            </div>

          </div>
        </div>
        <div id="new-server" class="content new-server">
          <h2 class="content-title">Add a<br>new server</h2>
          <form id="new-server-form" action="phploy/api/post.php?t=newserver" method="post">
            <div class="server-info">
              <div class="half">
                <label for="server-name">Server name</label>
                <input class="server-name" name="server-name" type="text" placeholder="My New Client" autocomplete="off"/>
              </div>
              <div class="half">
                <label for="site-url">Website url</label>
                <input class="site-url" name="site-url" type="url" placeholder="https://example.com" autocomplete="off"/><br />
              </div>
              <div class="half">
                <label for="server-url">FTP url</label>
                <input class="server-url" name="server-url" type="text" placeholder="127.0.0.1" autocomplete="off"/>
              </div>
              <div class="half">
                <label for="server-port">Port</label>
                <input class="server-port" name="server-port" type="text" value="21" autocomplete="off"/>
              </div>
            </div>
            <div class="user-info">
              <div class="half">
                <label for="server-user">Username</label>
                <input class="server-user" name="server-user" type="text" placeholder="username" autocomplete="off"/>
              </div>
              <div class="half">
                <label for="server-pass">Password</label>
                <input class="server-pass" name="server-pass" type="password" placeholder="password" autocomplete="off"/>
              </div>
            </div>
            <div class="branch-info">
              <div class="half">
                <label for="core-branch">Core branch</label>
                <input class="core-branch" name="core-branch" type="text" value="master" autocomplete="off"/>
              </div>
              <div class="half">
                <label for="mod-branch">Modules branch</label>
                <input class="mod-branch" name="mod-branch" type="text" placeholder="m-" autocomplete="off"/>
              </div>
            </div>
            <div class="half">
              <input id="new-server-submit" class="submit" type="submit" name="submit">
            </div>
            <div class="half">
              <svg id="new-server-spinner" class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                 <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
              </svg>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="assets/js/date.js"></script>
    <script src="assets/js/deploy.js"></script>
  </body>
</html>
