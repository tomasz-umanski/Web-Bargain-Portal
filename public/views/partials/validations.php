<div class="validations">
    <?php
        if(isset($validations)){
            foreach($validations as $validation) {
                echo $validation . "<br>";
            }
        }
    ?>
</div>
