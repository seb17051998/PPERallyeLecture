<?php echo validation_errors(); ?>
<?php echo form_open('Account/Create'); ?>
<label>Nom :</label><input type="text" name="nom"/><br>
<label>Prénom :</label><input type="text" name="prenom"/><br>
<label>Votre Email :</label><input type='email' name='login'/><br>
<label>Mot de passe :</label><input type='password' name='password'/><br>
<label>Confirmez le mot de passe</label><input type='password' name='passwordConfirmation'/><br>
<button type='submit'>Créez votre compte</button><br>
<?php echo form_close(); ?>