@extends('layouts.app')

@section('content')
<div style="width: 100%; display: flex; justify-content: center;">
  <div class="container" style="padding: 40px; width: 100%; max-width: 1100px;">
    <section class="profile-section">
      <div class="section-title" style="font-size: 20px; font-weight: 600; margin-bottom: 24px; display: flex; align-items: center; justify-content: flex-start;">👤 Profile</div>

      <div class="profile-card" style="border: 1px solid #ccc; border-radius: 8px; padding: 32px; margin-bottom: 32px;">
        <div class="profile-content" style="display: flex; gap: 32px;">
          <div style="text-align: center; flex-shrink: 0;">
            <div style="width: 160px; height: 160px; border-radius: 50%; background-color: #FFF3DC; margin-bottom: 10px;"></div>
            <div class="edit-profile-btn" style="font-size: 14px; color: #2C4B3F; text-decoration: underline; cursor: pointer;">Edit Profile ✎</div>
          </div>
          <form class="profile-form" style="flex-grow: 1;">
            <div class="form-group">
              <label> Name</label>
              <input type="text" name="first_name" value="Archie" class="form-control" style="width: 100%;">
            </div>
            
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" value="archie@gmail.com" class="form-control" style="width: 100%;">
            </div>
           
            <div style="display: flex; justify-content: flex-end;">
              <button type="submit" class="save-btn" style="background-color: #2C4B3F; color: white; padding: 10px 16px; border: none; border-radius: 4px; cursor: pointer; margin-top: 16px;">Save Changes</button>
            </div>
          </form>
        </div>
      </div>

      <div class="address-section" style="border: 1px solid #ccc; border-radius: 8px; padding: 32px; margin-bottom: 32px;">
        <div class="address-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
          <div class="section-title" style="margin: 0; font-size: 20px; font-weight: 600;">Addresses</div>
          <button class="add-address-btn" style="background-color: #2C4B3F; color: white; border: none; padding: 10px 16px; border-radius: 4px; cursor: pointer;">+ Add New Address</button>
        </div>
        <div class="address-item" style="border: 1px solid #ddd; border-radius: 6px; padding: 20px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <strong>Address 1</strong><br>
            Dyanlang St. Tagas Daraga, Albay, 4501 (Pink)
          </div>
          <div class="address-actions">
            <span style="margin-left: 12px; font-size: 14px; text-decoration: none; color: #2C4B3F; font-weight: 500; cursor: pointer;">✎ Edit</span>
            <span style="margin-left: 12px; font-size: 14px; color: #B00020; cursor: pointer; font-weight: 500;">🗑 Delete</span>
          </div>
        </div>
      </div>

      <div class="password-section" style="border: 1px solid #ccc; border-radius: 8px; padding: 32px; display: flex; flex-direction: column; align-items: center;">
        <div class="section-title" style="margin-bottom: 16px; font-size: 20px; font-weight: 600; width: 100%; text-align: center;">Update Password</div>
        <form style="width: 100%; max-width: 500px;">
          <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="current_password" class="form-control" style="width: 100%;">
          </div>
          <div class="form-group">
            <label>New Password</label>
            <input type="password" name="password" class="form-control" style="width: 100%;">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" style="width: 100%;">
          </div>
          <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="save-btn" style="background-color: #2C4B3F; color: white; padding: 10px 16px; border: none; border-radius: 4px; cursor: pointer; margin-top: 16px;">Save Changes</button>
          </div>
        </form>
      </div>
    </section>
  </div>
</div>
@endsection