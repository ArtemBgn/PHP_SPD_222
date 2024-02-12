<h1>Реєстрація</h1>
<form class="col s12" enctype="multipart/form-data" method="post" asp-action="/">
    <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">email</i>
          <input id="user-email" type="text" class="validate" name="email-user">
          <label for="user-email">Email</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">person</i>
          <input id="user-name" type="text" class="validate" name="name-user">
          <label for="user-name">Name</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">lock</i>
          <input id="user-password" type="password" class="validate" name="password-user">
          <label for="user-password">Password</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">lock</i>
          <input id="user-repeat-password" type="password" class="validate" name="repeat-password-user">
          <label for="user-repeat-password">Repeat password</label>
        </div>
    </div>
    <div class="file-field input-field">
      <div class="btn">
        <span><img src="/img/photo.png"/></span>
        <input type="file" name="avatar-user" id="user-avatar">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-success" type="submit">Реєстрація</button>
        </div>
    </div>
</form>