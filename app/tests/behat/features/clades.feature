Feature: Clades

Scenario: Finding a specific clade
    When I request "GET /organisms/1/clade"
    Then I get a "200" response
    And the "pagination" property is an object
    And the "data" property is an array
    And scope into the first "data" property
        And the properties exist:
            """
            id
            """
    And reset scope

Scenario: Finding a specific clade and children by depth
    When I request "GET /organisms/1/clade?depth=2"
    Then I get a "200" response
    And the "pagination" property is an object
    And the "data" property is an array
    And scope into the first "data" property
        And the properties exist:
            """
            id
            """
    And reset scope