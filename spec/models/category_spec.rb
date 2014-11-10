require 'rails_helper'

RSpec.describe Category, :type => :model do
  it "is a valid model" do
    @category = Category.create(name: "test")
    expect(@category).to be_valid
  end
  it "is a generates slug" do
    @category = Category.create(name: "test name")
    expect(@category.slug).to eq "test-name"
    @category1 = Category.create(name: "Cap name")
    expect(@category1.slug).to eq "cap-name"
  end
end
