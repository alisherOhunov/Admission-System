<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    | Flash messages, success/error feedback, and validation messages
    |
    */

    // Confirmation Messages
    'confirm_delete_period' => 'Are you sure you want to delete this period?',
    'confirm_delete_program' => 'Are you sure you want to delete this program?',

    // Restriction Messages
    'cannot_delete_active_program' => 'Cannot delete an active program.',

    // Generic Error Messages
    'invalid_data' => 'Invalid data provided.',
    'operation_failed' => 'Operation failed. Please try again.',
    'no_permission' => 'You do not have permission to perform this action.',

    // Generic Validation Messages
    'field_required' => 'The :field field is required before submitting.',
    'document_required' => 'The :document document is required before submitting.',
    'file_too_large' => 'File size exceeds the maximum allowed size.',
    'invalid_file_type' => 'Invalid file type.',
    'action_cannot_be_undone' => 'This action cannot be undone.',

    // Application-Specific Messages
    'application_submitted' => 'Your application has been submitted successfully.',
    'application_updated' => 'Your application has been updated successfully.',
    'application_cannot_edit' => 'You cannot edit a submitted application.',
    'document_uploaded' => 'Document uploaded successfully.',
    'document_removed' => 'Document removed successfully.',
    'upload_failed' => 'Upload failed',
    'upload_failed_retry' => 'Upload failed. Please try again.',
    'remove_failed' => 'Failed to remove file',
    'remove_failed_retry' => 'Failed to remove file. Please try again.',
    'profile_updated' => 'Profile updated successfully.',

    // Period-Specific Messages
    'period_created' => 'Application period created successfully.',
    'period_updated' => 'Application period updated successfully.',
    'period_deleted' => 'Application period deleted successfully.',
    'period_activated' => 'Application period activated successfully.',
    'period_deactivated' => 'Application period deactivated successfully.',
    'cannot_delete_active_period' => 'Cannot delete an active application period.',
    'cannot_deactivate_last_period' => 'Cannot deactivate the last active period. Please ensure at least one period remains active.',
    'cannot_delete_last_period' => 'Cannot delete the last active period. Please ensure at least one period remains active.',
    'cannot_delete_period_in_use' => 'Cannot delete this application period because it has associated applications.',

    // Program-Specific Messages
    'program_created' => 'Program created successfully.',
    'program_updated' => 'Program updated successfully.',
    'program_deleted' => 'Program deleted successfully.',
    'program_activated' => 'Program activated successfully.',
    'program_deactivated' => 'Program deactivated successfully.',
    'cannot_delete_program_in_use' => 'Cannot delete a program that is being used in applications.',

    // Site Settings Messages
    'settings_updated' => 'Site settings updated successfully.',
    'logo_uploaded' => 'Logo uploaded successfully.',
    'favicon_uploaded' => 'Favicon uploaded successfully.',

];
