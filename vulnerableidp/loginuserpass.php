<?php                                                                                                                                                                            
$this->data['header'] = $this->t('{login:user_pass_header}');                                                                                                                    
                                                                                                                                                                                 
if (strlen($this->data['username']) > 0) {                                                                                                                                       
    $this->data['autofocus'] = 'password';                                                                                                                                       
} else {                                                                                                                                                                         
    $this->data['autofocus'] = 'username';                                                                                                                                       
}                                                                                                                                                                                
                                                                                                                           
                                                                                                                                                                                 
?>                                                                                                                                                                               


<!-- This is the block of code responsible for the login failure message -->
<?php                                                                                                                                                                            
if ($this->data['errorcode'] !== null) {                                                                                                                                         
    ?>                                                                                                                                                                           
    <div style="border-left: 1px solid #e8e8e8; border-bottom: 1px solid #e8e8e8; background: #f5f5f5">                                                                                                                                                                   
        <p><strong><?php                                                                                                                                                         
                echo htmlspecialchars($this->t(                                                                                                                                  
                    '{errors:title_'.$this->data['errorcode'].'}',                                                                                                               
                    $this->data['errorparams']                                                                                                                                   
                )); ?></strong></p>                                                                                                                                              
                                                                                                                                                                                 
        <p><?php                                                                                                                                                                 
            echo htmlspecialchars($this->t(                                                                                                                                      
                '{errors:descr_'.$this->data['errorcode'].'}',                                                                                                                   
                $this->data['errorparams']                                                                                                                                       
            )); ?></p>                                                                                                                                                           
    </div>                                                                                                                                                                       
<?php                                                                                                                                                                            
}                                                                                                                                                                                

?>
    <center>                                                                                                                               
    <h1 style="break: both"><?php echo 'Jellystone IDP' ?></h1>                                                                                                                                                                                             
    <img src="/simplesamlphp/resources/welcome.png"></img>                                                                                                                                                                          
    <br>
    <form action="?" method="post" name="f" style="background-color:#E6E6FA">                                                                                                                                     
        <table>                                                                                                                                                                  
            <tr>                                                                                                                                                                 
                <td rowspan="2">                                                                                                                                                 
                                                            
                </td>                                                                                                                                                            
                <td><label for="username"><?php echo $this->t('{login:username}'); ?></label></td>                                                                               
                <td>                                                                                                                                                             
                    <input id="username" <?php echo ($this->data['forceUsername']) ? 'disabled="disabled"' : ''; ?>                                                              
                           type="text" name="username"                                                                                                                           
<?php if (!$this->data['forceUsername']) {                                                                                                                                       
    echo 'tabindex="1"';                                                                                                                                                         
} ?> value="<?php echo htmlspecialchars($this->data['username']); ?>"/>                                                                                                          
                </td>                                                                                                                                                            
            <?php                                                                                                                                                                
            if ($this->data['rememberUsernameEnabled'] && !$this->data['forceUsername']) {                                                                                       
                // display the "remember my username" checkbox                                                                                                                   
            ?>                                                                                                                                                                   
                <td>                                                                                                                                                             
                    <input type="checkbox" id="remember_username" tabindex="4"                                                                                                   
                           <?php echo ($this->data['rememberUsernameChecked']) ? 'checked="checked"' : ''; ?>                                                                    
                           name="remember_username" value="Yes"/>                                                                                                                
                    <small><?php echo $this->t('{login:remember_username}'); ?></small>                                                                                          
                </td>                                                                                                                                                            
            </tr>                                                                                                                                                                
            <?php                                                                                                                                                                
            }                                                                                                                                                                    
            ?>                                                                                                                                                                   
            <tr>                                                                                                                                                                 
                <td><label for="password"><?php echo $this->t('{login:password}'); ?></label></td>                                                                               
                <td>                                                                                                                                                             
                    <input id="password" type="password" tabindex="2" name="password"/>                                                                                          
                </td>                                                                                                                                                            
            <?php                                                                                                                                                                
            if ($this->data['rememberMeEnabled']) {                                                                                                                              
                // display the remember me checkbox (keep me logged in)                                                                                                          
            ?>                                                                                                                                                                   
                <td>                                                                                                                                                             
                    <input type="checkbox" id="remember_me" tabindex="5"                                                                                                         
                        <?php echo ($this->data['rememberMeChecked']) ? 'checked="checked"' : ''; ?>                                                                             
                           name="remember_me" value="Yes"/>                                                                                                                      
                    <small><?php echo $this->t('{login:remember_me}'); ?></small>                                                                                                
                </td>                                                                                                                                                            
            </tr>                                                                                                                                                                
            <?php                                                                                                                                                                
            }                                                                                                                                                                    
            if (array_key_exists('organizations', $this->data)) {                                                                                                                
                ?>                                                                                                                                                               
                <tr>                                                                                                                                                             
                    <td></td>                                                                                                                                                    
                    <td><label for="organization"><?php echo $this->t('{login:organization}'); ?></label></td>
                    <td><select name="organization" tabindex="3">
                            <?php
                            if (array_key_exists('selectedOrg', $this->data)) {
                                $selectedOrg = $this->data['selectedOrg'];
                            } else {
                                $selectedOrg = null;
                            }

                            foreach ($this->data['organizations'] as $orgId => $orgDesc) {
                                if (is_array($orgDesc)) {
                                    $orgDesc = $this->t($orgDesc);
                                }

                                if ($orgId === $selectedOrg) {
                                    $selected = 'selected="selected" ';
                                } else {
                                    $selected = '';
                                }

                                echo '<option '.$selected.'value="'.htmlspecialchars($orgId).'">'.htmlspecialchars($orgDesc).'</option>';
                            }
                            ?>
                        </select></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td></td><td></td>
                <td>
                    <button id="regularsubmit" class="btn"
                            onclick="this.value='<?php echo $this->t('{login:processing'); ?>';
                                this.disabled=true; this.form.submit(); return true;" tabindex="6">
                        <?php echo $this->t('{login:login_button}'); ?>
                    </button>
                </td>
            </tr>
        </table>
        <?php
        foreach ($this->data['stateparams'] as $name => $value) {
            echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
        }
        ?>
    </form>
<?php
if (!empty($this->data['links'])) {
    echo '<ul class="links" style="margin-top: 2em">';
    foreach ($this->data['links'] as $l) {
        echo '<li><a href="'.htmlspecialchars($l['href']).'">'.htmlspecialchars($this->t($l['text'])).'</a></li>';
    }
    echo '</ul>';
}
