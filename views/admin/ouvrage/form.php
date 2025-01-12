
<div class="center">
    <h1 title-page><?= $params['ouvrage']->nom ? 'Modifier <strong>'.$params['ouvrage']->nom .'</strong>': 'Ajouter un ouvrage' ?></h1>
</div>

<div class="card-livre">
    <div class="card-content-livre">
        <form id="form-ouvrage" action="<?= isset($params['ouvrage']) ? NAME_SITE.'/admin/ouvrages/edit/'.$params['ouvrage']->id : NAME_SITE.'/admin/ouvrages/add' ?>" method="POST" enctype='multipart/form-data'>
            <div class="form-group input-row">
                <label class="label-form" for="nom">Nom de l'ouvrage<strong>*</strong> : </label>
                <input type="text" name="nom" id="nom" 
                    <?php if($params['ouvrage']->nom != ''): ?> 
                        value="<?= stripslashes(htmlspecialchars($params['ouvrage']->nom)) ?>"
                    <?php endif ?>>
            </div>
            <div class="form-group">
                <label class="label-form" for="visible">Visible :</label>
                <span>
                    <input type="radio" name="visible" id="radio-visible-1" value="1" <?= !isset($params['ouvrage']) ? 'checked' : '' ?> <?= isset($params['ouvrage']) && $params['ouvrage']->visible==1 ? 'checked': ''?>>
                    <label for="radio-visible-1">Oui</label>
                </span>
                <span>
                    <input type="radio" name="visible" id="radio-visible-0" value="0"  <?= isset($params['ouvrage']) && $params['ouvrage']->visible==0 ? 'checked': ''?>>
                    <label for="radio-visible-0">Non</label>
                </span>
            </div>
            <div class="form-group">
                <label class="label-form" for="deux">Deux colonnes :</label>
                <span>
                    <input type="radio" name="deux" id="radio-deux-1" value="1"  <?= isset($params['ouvrage']) && $params['ouvrage']->deux==1 ? 'checked': ''?>>
                    <label for="radio-deux-1">Oui</label>
                </span>
                <span>
                    <input type="radio" name="deux" id="radio-deux-0" value="0" <?= !isset($params['ouvrage']) ? 'checked' : '' ?> <?= isset($params['ouvrage']) && $params['ouvrage']->deux==0 ? 'checked': ''?>>
                    <label for="radio-deux-0">Non</label>
                </span>
            </div>
            <div class="form-group">
                <label class="label-form" for="theme_id">Thème : </label>
                <select id="theme_id" name="theme_id" required>
                    <option value="0" default>--- choisir un thème ---</option>
                    <?php foreach($params['themes'] as $theme): ?>
                        <option value="<?= $theme->id ?>" <?= $params['ouvrage']->theme_id === $theme->id ? 'selected' : '' ?>>
                            <?= $theme->nom ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label class="label-form" for="categories">Catégorie(s)<strong>*</strong> : </label>
                <div id="categories">
                    <?php foreach($params['categories'] as $categorie): ?>
                        <div>
                            <input id="chk-categorie-<?= $categorie->id ?>" name="categories[]" type="checkbox" value="<?= $categorie->id ?>" 
                            <?php if (isset($params['ouvrage'])):?>
                                <?= $params['ouvrage']->hasCategorie($categorie->id) ? 'checked' : '' ?>
                            <?php endif ?>
                            />
                            <label for="chk-categorie-<?= $categorie->id ?>"><?= $categorie->nom ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            
            <label for="all_items"><strong>IMAGE(S)* :</strong></label>

            <input type="button" id="add_field_file" class="btn btn-form btn-green" value="Ajouter un champ d'image">
            <div id="all_items">
            
            <script>
                const chkCategories = document.getElementById('form-ouvrage').elements['categories[]'];
                var all_items = document.querySelector('#all_items');
                var btn_add_field_file = document.querySelector('#add_field_file');
                var boxes = [];
                var i = 0;
                var nbChildren = 0;

                function setFileName(event, file_name_hidden_id, file_name_id){
                    document.getElementById(file_name_hidden_id).value = event.target.files[0].name;
                    document.getElementById(file_name_id).textContent = event.target.files[0].name;
                }

                function add_field(label_param=null, fileName_param=null, idDB_param=null) {
                    // création des nouveaux noeuds
                    var divRow = document.createElement('div');
                    var divMiRow = document.createElement('div');
                    var label = document.createElement('label');
                    var inputLabel = document.createElement('input');
                    var inputFile = document.createElement('input');
                    var labelinputFile = document.createElement('label');
                    var fileNameHidden = document.createElement('input');
                    var fileName = document.createElement('span');
                    var btnDeleteField = document.createElement('input');

                    // paramétrage des nouveaux noeuds
                    divRow.id = `${i}`;
                    divRow.classList.add('row-add-item');
                    
                    divMiRow.classList.add('fx-50_100');
                    var divMiRow2 = divMiRow.cloneNode();

                    divMiRow.classList.add('input-row');
                    divMiRow2.classList.add('justify-row');

                    label.appendChild(document.createTextNode(`Légende:`));
                    label.htmlFor = `id_file_${i}`;
                    
                    inputLabel.id = `id_file_${i}`;
                    inputLabel.type = 'text';
                    
                    inputLabel.value = label_param;

                    if(fileName_param===null){
                        inputLabel.name =`new_labels[${i}]`;
                        inputFile.name = i;
                        inputFile.id = `hidden_file_input_${i}`;
                        inputFile.type = 'file';
                        inputFile.setAttribute('hidden_input', true);
                        inputFile.setAttribute('onChange', `setFileName(event,'file_name_hidden_${i}', 'file_name_${i}')`);
                        
                        labelinputFile.htmlFor = `hidden_file_input_${i}`;
                        labelinputFile.appendChild(document.createTextNode('Choisir une image'));
                        labelinputFile.classList.add('btn');
                        labelinputFile.classList.add('btn-form');
                        labelinputFile.classList.add('btn-blue');

                        fileNameHidden.id = `file_name_hidden_${i}`;
                        fileName.id = `file_name_${i}`;
                    }
                    else {
                        inputLabel.name =`labels[${idDB_param}][]`;
                        fileNameHidden.name = `labels[${idDB_param}][]`;
                    }

                    fileNameHidden.type='hidden';
                    fileNameHidden.value = (fileName_param!=null?fileName_param:'Aucun fichier choisi');

                    fileName.appendChild(document.createTextNode(fileNameHidden.value));

                    btnDeleteField.type = 'button';
                    btnDeleteField.classList.add('box');
                    btnDeleteField.classList.add('btn');
                    btnDeleteField.classList.add('btn-form');
                    btnDeleteField.classList.add('btn-warning');
                    btnDeleteField.value = 'Supprimer l\'image';
                    btnDeleteField.setAttribute('onClick','deleteField(event)' );

                    // raccord des noeuds
                    all_items.appendChild(divRow);
                    divRow.appendChild(divMiRow);
                    divMiRow.appendChild(label);
                    divMiRow.appendChild(inputLabel);

                    divRow.appendChild(divMiRow2);
                    if(fileName_param===null){
                        divMiRow2.appendChild(inputFile);
                        divMiRow2.appendChild(labelinputFile);
                    }
                    divMiRow2.appendChild(fileNameHidden);
                    divMiRow2.appendChild(fileName);
                    divMiRow2.appendChild(btnDeleteField);

                    boxes[i] = btnDeleteField;
                    i++;
                    nbChildren++;
                }

                window.addEventListener("load", ()=>{
                    if(i<1){
                        add_field();
                    }
                })

                btn_add_field_file.addEventListener("click", ()=>{
                    add_field();
                })  

                function deleteField(event) {
                    // recherche de l'élément parent
                    var divParent = event.target.parentNode.parentNode;
                    if(nbChildren > 1){
                        var idParent = divParent.id;
                        // application de la suppression
                        all_items.removeChild(divParent);
                        boxes[idParent] = null;
                        nbChildren--;
                    }
                }

                function setFileNameInput(event, name){
                    event.target.value = name;
                }

                function categorieChecked(){
                    for(let i=0; i<chkCategories.length; i++){
                        if(chkCategories[i].checked){
                            return true;
                        }
                    }
                    return false;
                }

                function form_is_valid(event){
                    if(document.getElementById('form-ouvrage').elements['nom'].value === "" ){
                        alert('Le nom est obligatoire');
                        event.preventDefault();
                    }
                    else if(!categorieChecked()){
                        alert('Vous devez cocher au moins une catégorie.');
                        event.preventDefault();
                    }
                    else if(document.getElementById('file_name_hidden_'+ all_items.lastChild.id).value==="Aucun fichier choisi"){
                        if (nbChildren === 1){
                            alert('Il doit y avoir au moins une image');
                        } else {
                            alert('Pensez à supprimer les champs non remplis, et laisser au moins une image');
                        }                    
                        event.preventDefault();
                    }
                    else {
                        event.target.click();
                    }
                }
            </script>
            <?php if(isset($params['ouvrage'])): ?>
                <?php foreach ($params['ouvrage']->getItems() as $item): ?>
                    <script>
                add_field("<?= $item->label?>","<?= $item->img?>", <?= $item->id?>);
                    </script>
                <?php endforeach ?>
            <?php endif ?>

            </div>
            <div class="btn-container">
                <a class="btn btn-big btn-golden" href="<?= NAME_SITE.'/admin/ouvrages' ?>">Retour</a>
                <input onclick="form_is_valid(event)" class="btn btn-big btn-green" type="submit" value="<?= isset($params['ouvrage']) ? 'Enregistrer les modifications' : 'Ajouter l\'ouvrage' ?>"/>
            </div>
        </form>
    </div>
</div>


