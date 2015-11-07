<h3>Stanislav</h3>

<h3>Cours:</h3>
<p>
    420-267 MO Développer un site Web et une application pour Internet<br/>
    Automne 2015, Collège Montmorency
</p>

<h3>Pour vérifier les exigences du TP2:</h3>
<ol>
    <li>Vérifier github: voir github.com/stasqc/cakephp</li>
    <li>Vérifier téléversement d'images: se logger comme admin, et créer un livre en choisissant une image</li>
    <li>Listes liés avec AJAX: aller pour rajouter un livre, Dans covers Choisir Overcover(Hard/Soft) pour avoir (Hardcover, Libary binding ou Softcover, Mass market paperback)</li>
    <li>Autocomplete: lors du rajout du livre, le nom de l'auteur se fait en autocomplete</li>
    <li>Fonction e-mail lors de l'enregistrement: on envit un e-mail automatiquement lors d'une registration. Pour tester, créer un nouveau compte avec un email valide. SI PAS AUTHORISÉ - on ne peut pas faire de réservations.</li>
    <li>Fonction e-mail après enregistrement : testUserMail n'est pas authorizé. Pour tester l'envoi du e-mail après une registration: aller dans Reservations, en dessous - send verification email</li>
</ol>

<p>BD: thelibrary.sql et db/bdbackup.sql</p>

<h3>Diagramme de base originale:</h3>
<?php echo $this->Html->image('http://www.databaseanswers.org/data_models/library/images/library_conceptual.gif', array('alt' => 'Image DB')); ?>

<h3>Lien vers ce diagramme:</h3>
<?php echo $this->Html->link('http://www.databaseanswers.org/data_models/library/index.htm');?>