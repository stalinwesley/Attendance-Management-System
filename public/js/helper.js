$.ajaxModal = function(selector, url, onLoad) { $(selector).removeData('bs.modal').modal({ remote: url, show: true }); // Trigger to do stuff with form loaded in modal $(document).trigger("ajaxPageLoad"); // Call onload method if it was passed in function call if (typeof onLoad != "undefined") { onLoad(); } // Reset modal when it hides $(selector).on('hidden.bs.modal', function () { $(this).find('.modal-body').html('Loading...'); $(this).find('.modal-footer').html('<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>'); $(this).data('bs.modal', null); }); };