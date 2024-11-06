<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Models\Audit;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the audit logs.
     */
    public function index()
    {
        $audits = Audit::with('user')->latest()->get();  // Fetch audit logs, including user information
        return view('admin.audit_logs.index', compact('audits'));
    }

    /**
     * Display the details of a specific audit log.
     */
    public function show(Audit $audit)
    {
        return view('admin.audit_logs.show', compact('audit'));
    }
}
