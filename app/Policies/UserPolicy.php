<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * General method to check user permissions.
     */private function hasPermission(User $user, string $permission): bool
        {
            // Retrieve permissions from the user (ensure it's not null)
            $permissions = $user->permissions->permissions ?? '{}';

            // Decode only if it's a string
            if (is_string($permissions)) {
                $permissions = json_decode($permissions, true);
            }

            // Convert string "1" to integer 1
            $permissions = array_map(function($value) {
                return $value === "1" ? 1 : $value;
            }, $permissions);

            // Log the permissions to check if they are being decoded properly
            \Log::info('Decoded Permissions: ', $permissions);

            // Check if the permission exists and is set to 1
            return isset($permissions[$permission]) && $permissions[$permission] === 1;
        }

    // KYC Section
    public function addKYC(User $user)
    {
        return $this->hasPermission($user, 'add_kyc');
    }

    public function viewKYC(User $user)
    {
        return $this->hasPermission($user, 'view_kyc');
    }

    public function changeKYC(User $user)
    {
        return $this->hasPermission($user, 'change_kyc');
    }

    public function approveKYC(User $user)
    {
        return $this->hasPermission($user, 'approve_kyc');
    }

    // Documents Section
    public function addDocuments(User $user)
    {
        return $this->hasPermission($user, 'add_documents');
    }

    public function viewDocuments(User $user)
    {
        return $this->hasPermission($user, 'view_documents');
    }

    public function changeDocuments(User $user)
    {
        return $this->hasPermission($user, 'change_documents');
    }

    public function approveDocuments(User $user)
    {
        return $this->hasPermission($user, 'approve_documents');
    }

    // Sales Section
    public function addSales(User $user)
    {
        return $this->hasPermission($user, 'add_sales');
    }

    public function viewSales(User $user)
    {
        return $this->hasPermission($user, 'view_sales');
    }

    public function changeSales(User $user)
    {
        return $this->hasPermission($user, 'change_sales');
    }

    public function approveSales(User $user)
    {
        return $this->hasPermission($user, 'approve_sales');
    }

    // Services Section
    public function addServices(User $user)
    {
        return $this->hasPermission($user, 'add_services');
    }

    public function viewServices(User $user)
    {
        return $this->hasPermission($user, 'view_services');
    }

    public function changeServices(User $user)
    {
        return $this->hasPermission($user, 'change_services');
    }

    public function approveServices(User $user)
    {
        return $this->hasPermission($user, 'approve_services');
    }

    // Users Section 
    public function addUser(User $user)
    {
        return $this->hasPermission($user, 'add_user');
    }

    public function viewUsers(User $user)
    {
        return $this->hasPermission($user, 'view_users');
    }

    public function changeUser(User $user)
    {
        return $this->hasPermission($user, 'change_user');
    }

    public function deleteUser(User $user)
    {
        return $this->hasPermission($user, 'delete_user');
    }

    public function toggleUsersSection(User $user)
    {
        return $this->hasPermission($user, 'toggle_users_section');
    }

    public function toggleDepartmentsSection (User $user) {
        return $this->hasPermission($user, 'toggle_Departments_Section');
    }

    public function viewdepartments(User $user){
        return $this->hasPermission($user, 'view_departments');
    }

    public function adddepartments(User $user){
        return $this->hasPermission($user, 'add_departments');
    }
    public function changedepartments(User $user){
        return $this->hasPermission($user, 'change_departments');
    }
    public function deletedepartments(User $user){  
        return $this->hasPermission($user, 'delete_departments');
    }

    public function toggleDocumentsSection (User $user) {
        return $this->hasPermission($user, 'toggle_Documents_Section');
    }
    public function viewSideBarDocuments(User $user){
        return $this->hasPermission($user, 'view_sideBarDocuments');
    }
    public function addSideBarDocuments(User $user){
        return $this->hasPermission($user, 'add_sideBarDocuments');
    }
    public function changeSideBarDocuments(User $user){
        return $this->hasPermission($user, 'change_sideBarDocuments');
    }
    public function deleteSideBarDocuments(User $user){
        return $this->hasPermission($user, 'delete_sideBarDocuments');
    }

    public function toggleMerchantCategoriesSection (User $user) {
        return $this->hasPermission($user, 'toggle_Merchant_Categories_Section');
    }
    public function viewMerchantCategories(User $user){
        return $this->hasPermission($user, 'view_merchantCategories');
    }
    public function addMerchantCategories(User $user){
        return $this->hasPermission($user, 'add_merchantCategories');
    }
    public function changeMerchantCategories(User $user){
        return $this->hasPermission($user, 'change_merchantCategories');
    }
    public function deleteMerchantCategories(User $user){
        return $this->hasPermission($user, 'delete_merchantCategories');
    }

    public function toggleCountriesSection (User $user) {
        return $this->hasPermission($user, 'toggle_Countries_Section');
    }
    public function viewCountries(User $user){
        return $this->hasPermission($user, 'view_countries');
    }
    public function addCountries(User $user){
        return $this->hasPermission($user, 'add_countries');
    }
    public function changeCountries(User $user){
        return $this->hasPermission($user, 'change_countries');
    }
    public function deleteCountries(User $user){
        return $this->hasPermission($user, 'delete_countries');
    }

    public function toggleActivityLogsSection (User $user) {
        return $this->hasPermission($user, 'toggle_Activity_LogsSection');
    }
    public function viewMyActivityLogs(User $user){
        return $this->hasPermission($user, 'my_activity_logs');
    }
    public function addAllActivityLogs(User $user){
        return $this->hasPermission($user, 'all_activity_logs');
    }


        // Merchant Section
    public function addMerchant(User $user)
    {
        return $this->hasPermission($user, 'add_merchant');
    }

    public function viewMerchants(User $user)
    {
        return $this->hasPermission($user, 'view_merchants');
    }

    public function changeMerchant(User $user)
    {
        return $this->hasPermission($user, 'change_merchant');
    }

    public function deleteMerchant(User $user)
    {
        return $this->hasPermission($user, 'delete_merchant');
    }

    public function toggleMerchantsSection(User $user)
    {
        return $this->hasPermission($user, 'toggle_merchants_section');
    }


    // Service Types Section
    public function toggleServicesSection(User $user)
    {
        return $this->hasPermission($user, 'toggle_Services_Section');
    }

    public function viewSideBarServices(User $user)
    {
        return $this->hasPermission($user, 'view_sideBarServices');
    }

    public function addSideBarServices(User $user)
    {
        return $this->hasPermission($user, 'add_sideBarServices');
    }

    public function changeSideBarServices(User $user)
    {
        return $this->hasPermission($user, 'change_sideBarServices');
    }

    public function deleteSideBarServices(User $user)
    {
        return $this->hasPermission($user, 'delete_sideBarServices');
    }



}


