<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Form Elements</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Datepicker, Autocomplete, WYSIWYG</legend>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Auto complete </label>
                        <div class="controls">
                            <input type="text" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            <p class="help-block">Start typing to activate auto complete!</p>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="date01">Date input</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge datepicker" id="date01" value="<?php echo date('d/m/Y');?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="fileInput">File input</label>
                        <div class="controls">
                            <input class="input-file uniform_on" id="fileInput" type="file">
                        </div>
                    </div>          
                    <div class="control-group">
                        <label class="control-label" for="textarea2">Textarea WYSIWYG</label>
                        <div class="controls">
                            <textarea class="cleditor" id="textarea2" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->