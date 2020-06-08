import { TestBed } from '@angular/core/testing';

import { APIServisService } from './apiservis.service';

describe('APIServisService', () => {
  let service: APIServisService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(APIServisService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
