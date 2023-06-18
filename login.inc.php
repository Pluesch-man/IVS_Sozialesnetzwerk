<form action="login.php" method="POST">
  <div>
    <span class="fehlermeldung"></span>
  </div>
  <div>
    <label class="reg_label">Userid</label>
    <span class="pflichtmarker"> *</span>
    <input type="text" name="userid" maxlength="20" required>
    <span class="fehlermeldung"></span>
  </div>
  <div>
    <label class="reg_label">Passwort</label>
    <span class="pflichtmarker"> *</span>
    <input type="password" name="pw" maxlength="50" required>
    <span class="fehlermeldung"></span>
  </div>
  <div>
    <input type="submit" value="Anmelden">
  </div>
</form>
