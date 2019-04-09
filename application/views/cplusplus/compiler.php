        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message')?>
            </div>
          </div>
              <section class="section">
              <div class="container">
                <div class="article-about">
                  <label for="lng">Bahasa Pemrograman : </label>
                  <select id="lng">
                    <option value="C++">C++</option>
                    <option value="PHP">PHP</option>
                  </select>      
                  <textarea id="codearena" class="article-define" style="width: 100%; height: 100px;"></textarea>
                  <button id="compile" target="_blank" class="btnCompile"><div id="loading">Compile</div></button>
                  <!-- <button>Download</button> -->
                  <div id="result" class="article-define" style="width: 100%; height: 100px;"></div>    
                </div>
              </div>
              </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>              
<script>
  $(document).ready(function()
  {
      $( document ).ajaxStart(function() 
      {
        $('#compile').attr('disabled', 'disabled')
        $( "#loading" ).html("<i class='fas fa-cog fa-spin'></i>Compiling..");
      });
      $('#lng').change(function()
        {
          var xdccd = $(this).prop('selectedIndex');
          console.log(xdccd);
          var test = "test";
          
          switch(xdccd)
          {
            case 0:
            editor.getDoc().setValue('#include <iostream> \n\rusing namespace std; \n\rint main() \n{ \n  //input code here \n  return 0; \n}');
            editor.setOption("mode", "text/x-c++src");
            type = "C++";
            break

            case 1:
            editor.getDoc().setValue("<" + "?php\n\r//input code here\n\r?>");
            editor.setOption("mode", "application/x-httpd-php");
            type = "PHP";
            console.log(type);
            break;
          }
        });
      $('#compile').click(function()
        {
          $.ajax(
          {
            type : "POST",
            url : "<?php echo base_url();?>cplusplus/t_ajax",
            data : {"type":type,"code":editor.getValue()},
            success:function(result)
            {
              console.log(type);
              console.log(editor);
            },
            complete:function(compiled)
            {
              $.ajax(
              {
                url: '<?php echo base_url('assets/');?>code/code-editable.php',
                type: 'POST',
                success:function(response)
                {
                  $( "#loading" ).html("Compile");
                  $('#compile').removeAttr('disabled');
                  console.log("response:  "+response);
                  $("#result").html(response) ;
                },
                error:function()
                {
                  console.log("error: "+response);
                }
              });
            }
          });
        });
      var type = "C++";
      var editor = CodeMirror.fromTextArea(codearena, 
      {
        value: "",
        lineNumbers: true,
        mode: "text/x-c++src",
        keyMap: "sublime",
        autoCloseBrackets: true,
        matchBrackets: true,
        showCursorWhenSelecting: true,
        theme: "monokai",
        tabSize: 2
      });
      editor.getDoc().setValue("#include <iostream> \n\rusing namespace std; \n\rint main() \n{ \n  //input code here \n  return 0; \n}");
  });
</script>              
          </div>

        
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

