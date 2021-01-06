<div id="addNotes" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="color:black">Add Notes</h3>
            </div>
            <div class="modal-body">
                <div class="table-repsonsive">
                    <table class="table table-striped text-dark">
                        <tr>
                            <td> VIN </td>
                            <td><select id = "vin_numbers" class ="form-control"></select></td>
                        </tr>

                        <tr>
                            <td> Note: </td>
                            <td> <textarea id = "noteArea" class="form-control"> </textarea> </td>
                        </tr>
                                
                    </table>
                </div>
            <div class="modal-footer">
            
            <button type="button" class="btn btn-primary"  id="saveNote" onclick="saveNote()">Save Note</button> 
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

        </div>
    </div>
</div>