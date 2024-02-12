<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

<div id="modal1" class="modal">
  <form class="col s12" method="post" asp-action="/">
    <div class="modal-content mymodel">
      <h4 class="mymodel">Введіть e-mail та пароль для входу</h4>
      <div class="input-field col s6">
          <i class="material-icons prefix">email</i>
          <input id="user-input-email" type="text" class="validate" name="email-user-input">
          <label for="user-input-email">Email</label>
      </div>
      <div class="input-field col s6">
          <i class="material-icons prefix">lock</i>
          <input id="user-input-password" type="password" class="validate" name="password-user-input">
          <label for="user-input-password">Password</label>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Закрити</a>
      <button type="submit">Вхід</button>
    </div>
  </form>
</div>