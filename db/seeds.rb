# This file should contain all the record creation needed to seed the database with its default values.
# The data can then be loaded with the rake db:seed (or created alongside the db with db:setup).
#
# Examples:
#
#   cities = City.create([{ name: 'Chicago' }, { name: 'Copenhagen' }])
#   Mayor.create(name: 'Emanuel', city: cities.first)
categories = ["Abandoned Cart", "Activation", "Activity", "Alerts", "Announcement", "Confirmation", "Customer Appreciation", "Deactivation", "Discovery", "Ecommerce", "Email Digest", "Engagement", "Events", "Expiration", "Featured Product", "Invitation", "Marketing", "New Article", "Newsletter", "Notice", "Onboarding", "Password Recovery", "Password Reset", "Product Launch", "Product Sale", "Product Update", "Promotion", "Re-engagement", "Receipt", "Report", "Retention", "Reviews", "Security", "Sharing", "Social", "Support", "Survey", "Text", "Transactional", "Upselling", "Video", "Welcome"]

categories.each do |category|
  Category.create(name: category)
end