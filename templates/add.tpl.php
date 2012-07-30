<div id='addPage' class='addPage'>
    <img src="css/images/add.png" alt='Ajouter'/>
    <span>Ajouter une page</span>
</div>

<form id="contentPageAdd" style='display: none; color: white; border: 1px solid red;' method="POST">
    Titre <input type='text' id='newTitre' /><br />
    Contenu de la page<br /><textarea name="contentNewPage" id="contentNewPage"></textarea>
    <?php $pages = Book::getAllPages(); ?>
    Mettre après la page <select id='idPrecedent'>
        <?php foreach($pages as $page) : ?>
            <option value='<?php echo $page->getId(); ?>'><?php echo $page->getTitre(); ?></option>
        <?php endforeach; ?>
    </select>
</form>