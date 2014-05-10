Feature: Organisms

Scenario: Finding a specific organism
    When I request "GET /organisms/1"
    Then I get a "200" response
    And scope into the "data" property
        And the properties exist:
            """
            id
            name
            classification
            description
            images
            url
            """
        And the "id" property is an integer
        And the "images" property is an array
    And reset scope

Scenario: Finding a specific organism by invalid id
    When I request "GET /organisms/foo"
    Then I get a "404" response

Scenario: Listing all organisms is not possible
    When I request "GET /organisms"
    Then I get a "400" response

Scenario: Searching non-existent organisms
    When I request "GET /organisms?q=Foo+Bar"
    Then I get a "200" response
    And the "data" property contains 0 items

Scenario: Searching organisms by partial classication
    When I request "GET /organisms?q=Homo"
    Then I get a "200" response
    And the "pagination" property is an object
    And the "data" property is an array
    And scope into the first "data" property
        And the properties exist:
            """
            id
            name
            classification
            description
            images
            url
            """
    And reset scope

Scenario: Searching organisms by full classication
    When I request "GET /organisms?q=Homo+Sapiens"
    Then I get a "200" response
    And the "pagination" property is an object
    And the "data" property is an array
    And scope into the "data" property
        And the properties exist:
            """
            id
            name
            classification
            description
            images
            url
            """
    And reset scope