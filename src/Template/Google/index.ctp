

<style>
    * {
  box-sizing: border-box;
}
.invalid-feedback {
        display: block;
    }
.gallery-inner img{
    width: 30rem;
    height: 30rem
}
.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
  margin-left: 2rem;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: black;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
  margin-top: 4rem;
  padding-left: .5rem;
  padding-right: .5rem;
  transition: 0.6s ease;
  border-radius: 1rem;
  user-select: none;
  -webkit-user-select: none;
}

.mySlides {
  display: none;
}
.mySlides img{
  height: 20%;
}
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev{
    left: 0rem;
}
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: black;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.close:hover,
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
  color: white
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
    .tab-content .image img{
        width: 5rem;
        height: 5rem;
        border-radius: 50%;
    }
    .tab-content .image
    {
        float: left;
    }
    .col .select-info{
        float: left;
        width: 25rem;
    }
    .col .content-info{
        width: 20rem;
        float: right;
        display: flex;
        height: 5rem;
        margin-right: 10rem;
    }
    .col .content-info .info{
        float: right;
        margin-left: 1rem;

    }
    .col textarea
    {
        height: 10rem;
    }
    .row h1{
        padding: 2rem;
        margin-top: -4rem;
    }
    .device-images .view-image{
        display: flex;
    }
    .device-images .view-image img{
        width: 8rem;
        height: 8rem;
    }
    .info{
        display: flex;
    }
    .user-tab{
        display: flex;
    }
    .device-info{
        margin-top: 1rem;
        margin-left: 1rem;
    }
    .user-info{
        margin-left: 1rem;
    }
    .device{
        margin-top: 2rem;
        margin-left: 1rem;
    }
    .user{
        margin-top: 2rem;
    }
    .user-tab img{
        width: 5rem;
        height: 5rem;
        border-radius: 5rem;
    }
    .device-tab
    {
        display: flex;
    }
    label{
        font-weight: bold;
        font-size: 1.5rem;
    }
    h1{
        text-align: center;
    }    
    .fa{
        padding-right: .5rem;
    }
</style>

<head>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">
    

</head>
<div class="">
      <a href="<?php echo $client->createAuthUrl();?>">Login</a>
        <?= $this->Form->create(null, [
        'url' => [
            'controller' => 'Google',
            'action' => 'index',
            '?' => !empty($query) ? $query : ''
        ],
        'method' => 'post',
        'novalidate',
        'enctype' => 'multipart/form-data',
    ]); ?>
    <div class="" style="margin: 0 auto;">
        <div class="px-4 py-5" style="background-color: #f7f9fa">
        <h1>Return Device <?php echo !empty($find_assign['device']['name'])  ? $find_assign['device']['name'] : '' ; ?></h1>
        <?php echo $this->Flash->render() ?>
        
        <div class="row mb-3">
                <label class="active">Confirmation Photos</label>
                <div class="input-field">
                    <div class="input-images form-control <?= isset($error['images']) ? 'is-invalid' : ''  ?>" name='images' value="<?php echo !empty($team['images']) ? $team['images'] : '' ; ?>" style="padding-top: .5rem;"></div>
                </div>
                <div class="invalid-feedback">
                    <?php if(!empty($error['images']))
                        foreach ($error['images'] as $msg) {
                            echo $msg.'<br>';
                    }  ?>
                </div>
        </div>
      <?php if(!empty($upload)):
        foreach($upload as $key => $image): ?>
        <img src="https://drive.google.com/uc?export=view&id=<?php echo !empty($image) ? $image : '' ?>">
      <?php endforeach;
        endif;
      ?>
      <div class="d-grid gap-2 d-md-block text-center">
          <a href="/Assign" class="btn btn-outline-secondary" type="button">Cancel</a>
          <button class="btn btn-secondary" type="submit">Save</button>
      </div>
    </div>
</div>
    

<?= $this->Form->end() ?>
<script type="text/javascript" src="http://example.com/jquery.min.js"></script>
<script type="text/javascript" src="http://example.com/image-uploader.min.js"></script>
<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            errorPlacement: function(error, element) {
                if(element.parent().length) {
                    element.parent().append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $('.input-images').imageUploader();
    });
</script>
