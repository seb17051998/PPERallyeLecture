<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('livre/add');?>">Ajouter</a>
</div>
<?php
    echo form_open('Livre/index');
?>
<table>
    
    <tr>
    
        <td><input type="submit" value="#" name="id"></td>
        <td><input type="submit" value="Titre" onclick=""></td>
        <td><input type="submit" value="couverture" name="couverture"></td>
        <td><input type="submit" value="id auteur" name="idAuteur"></td>
        <td><input type="submit" value="nom auteur" name="nomAuteur"></td>
        <td><input type="submit" value="id editeur" name="idEditeur"></td>
        <td><input type="submit" value="id quizz" name="idQuizz"></td>
        <?php
            echo form_close();
            ?>
        <td>image</td>
        <td>Actions</td>
    </tr>
 
    <?php foreach ($livres as $l): ?>
        <tr>
            <td><?php echo $l['id']; ?></td>
            <td><?php echo $l['titre']; ?></td>
            <td><?php echo $l['couverture']; ?></td>
            <td><?php echo $l['idAuteur']; ?></td>
            <td><?php echo $l['nom']; ?></td>
            <td><?php echo $l['idEditeur']; ?></td>
            <td><?php echo $l['idQuizz']; ?></td>
            <td><img src="<?php echo base_url('img/'.$l['couverture']) ?>" alt="<?php echo $l['titre']; ?>" height="50" width="50"> </td>
            <td>
                <a href="<?php echo site_url('livre/edit/'.$l['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('livre/remove/'.$l['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php
echo $links;
?>
<?php
   
?>