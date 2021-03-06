
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>

<?php if(isset($_SESSION['code']) && ($_SESSION['code'] == 1)): ?>
    <div id="addPageBorder">
        <div id='addPage' class='addPage'>
            <img src="css/images/add_v2.png" alt='Ajouter'/>
            <span><a class='inline savePage' href="#contentPageAdd" title="Sauvegarder">Ajouter une page</a></span>
            <span class='annulerAddPage'>Annuler</span>
        </div>
    </div>
<?php endif ?>

<div style='display:none'>
    <form id="contentPageAdd" style='color: white;' method="POST">
        <div class='left addPage'>Titre : <br /><input type='text' id='newTitre' /></div>
        <div class='right addPage'>
            <?php $pages = Book::getAllPages(); ?>
            Page suivante : <select id='idPrecedent'>
                <?php foreach($pages as $page) : ?>
                    <option value='<?php echo $page->getId(); ?>'><?php echo $page->getTitre(); ?></option>
                <?php endforeach; ?>
                <option value='null'>Aucune</option>
            </select>
        </div><br/>
        <div>Contenu de la page<br /><textarea name="contentNewPage" id="contentNewPage"></textarea></div>
    </form>
</div>